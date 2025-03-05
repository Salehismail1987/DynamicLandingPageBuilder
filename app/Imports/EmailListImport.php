<?php

namespace App\Imports;

use App\Models\EmailList;
use App\Models\ContactDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmailListImport implements ToModel, WithHeadingRow
{
    protected $columnDefinitions;

    public function __construct()
    {
        // Replace with actual retrieval logic
        $fields = ContactDatabase::first();
        $this->columnDefinitions = json_decode($fields->fields, true);
    }

    public function model(array $row)
    {
        // Build validation rules
        $rules = $this->buildValidationRules();

        // Validate the row
        $validator = Validator::make($row, $rules, $this->customValidationMessages());

        if ($validator->fails()) {
            // Handle validation failures (e.g., log errors, skip row, etc.)
            // You can log the errors or throw an exception
            // throw new \Illuminate\Validation\ValidationException($validator);
            return null; // Skip invalid rows
        }

        // Map data
        $data = [];
        $row = array_filter($row, function($value) {
            return !is_null($value);
        });

        foreach ($this->columnDefinitions as $column) {
            $fieldName = $column['fieldname'];
            $fieldNameSnakeCase = $this->convertToSnakeCase($fieldName);

            if(isset($row[$fieldNameSnakeCase]) && in_array($column['fieldtype'], ['date'])){
                $row[$fieldNameSnakeCase] =  Date::excelToDateTimeObject($row[$fieldNameSnakeCase])->format('Y-m-d');
            }
            if(isset($row[$fieldNameSnakeCase]) && in_array($column['fieldtype'], ['time'])){
                $row[$fieldNameSnakeCase] =  Date::excelToDateTimeObject($row[$fieldNameSnakeCase])->format('H:i:s');
            }

            if (isset($row[$fieldNameSnakeCase]) && in_array($column['fieldtype'], ['file', 'image'])) {
                $fileUrl = $row[$fieldNameSnakeCase];
                if($fileUrl !='file url'){
                    // Validate the URL
                    if (filter_var($fileUrl, FILTER_VALIDATE_URL)) {
                        // Get the file content from the URL
                        // $fileContent = file_get_contents($fileUrl);
                        $response = Http::get($fileUrl);

                        // Generate a unique filename
                        $filename = Str::uuid() . '.' . pathinfo($fileUrl, PATHINFO_EXTENSION);

                        // Save the file to the storage (e.g., 'public/uploads' directory)
                        // Storage::put("public/uploads/{$filename}", $fileContent);
                        // Storage::put("assets/uploads/".get_current_url().$filename, $fileContent);
                        $filePath = "assets/uploads/".get_current_url().'/'."{$filename}";
                        file_put_contents($filePath, $response->body());

                        // Store the filename in the data array
                        $row[$fieldNameSnakeCase] = $filename;
                    }
                }


            }

            if (isset($row[$fieldName])) {
                $data[$fieldName] = $row[$fieldName];
            }
        }
        // Perform necessary processing, e.g., save data to the database
        $data['fields'] = json_encode($row);
        $data['email_address'] = $row['email'] ?? null;
        $data['name'] = $row['full_name'] ?? null;
        $data['subscribed'] = isset($row['subscribed']) && $row['subscribed'] ? '1' : '0';

        $new = new EmailList();
        $new->fields = $data['fields'];
        $new->email_address = $data['email_address'];
        $new->name = $data['name'];
        $new->subscribed = $data['subscribed'];
        $new->save();

        // $res = EmailList::create($data);

    }

    protected function buildValidationRules()
    {
        $rules = [];

        foreach ($this->columnDefinitions as $column) {
            $fieldName = $column['fieldname'];
            $fieldNameSnakeCase = $this->convertToSnakeCase($fieldName);
            $fieldRules = [];

            if ($column['required'] === '1') {
                $fieldRules[] = 'required';
            }

            if ($column['fieldtype'] === 'email') {
                $fieldRules[] = 'email';
            }

            if ($column['fieldtype'] === 'text') {
                $fieldRules[] = 'string';
            }

            if ($column['fieldtype'] === 'select') {
                $fieldRules[] = 'string';
            }

            if ($column['fieldtype'] === 'file') {
                $fieldRules[] = 'string';
            }

            if ($column['fieldtype'] === 'radio') {
                $fieldRules[] = 'string';
            }

            // Append rules for the field
            if (!empty($fieldRules)) {
                $rules[$fieldNameSnakeCase] = implode('|', $fieldRules);
            }
        }

        return $rules;
    }

    public function customValidationMessages()
    {
        return [
            // Define custom validation messages if necessary
        ];
    }

    public function convertToSnakeCase($string) {
        // Convert the string to lowercase
        $string = strtolower($string);

        // Replace spaces with underscores
        $string = str_replace(' ', '_', $string);

        return $string;
    }
}
