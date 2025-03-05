@extends('admin.layout.dashboard')
<style>
    .checksize {
        width: 20px;
        height: 20px;
    }

    td[aria-expanded=false] .fa-chevron-up {
        display: none;
    }

    td[aria-expanded=true] .fa-chevron-down {
        display: none;
    }

    .form-footer-buttons{
        position: fixed;
        bottom: 3%;
        background: #cccccc;
        padding: 20px;
        left: 50%;
        transform: translate(-38%);
        width: 30%;
        text-align: center;
    }

    @media (max-width: 1080px) {
        table {
            display: block;
            width: 100%;
            overflow-x: auto;
        }

    }

    @media (max-width: 789px) {

        .form-footer-buttons{
            padding: 5px;
            bottom: 1%;
            width: 60%;
        }

    }

   

    
</style>
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">EDIT Permissions</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('businessinfo?block=permissions') ?>" class="btn btn-info " >
                    Back
                </a>
            </li>
        </ol>
    </div>

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          {{ session()->get('error') }}
        </div>
      @endif
      @if(session()->has('success'))
        <div class="alert alert-primary alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          {{ session()->get('success') }}
        </div>
      @endif
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">EDIT Permissions</h6>
            <div class="form-group">
                <label for="bannertext">Toggle All</label>
                <label class="switch">
                <input type="checkbox" class="notificationswitch" name="toggle_all" id="toggle_all" onchange="toggle_all_permissions(<?= $catID ?>)">
                <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="card-body">
            <form role="form" method="post" enctype="multipart/form-data" action="<?php echo url('updatepermissions/'. $catID) ?>">
            @csrf
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th> Sr# </th>
                            <th>Module</th>
                            <th> Action </th>
                            <th></th>
                        </tr>
                    </thead> 
                    <?php $i = 1; ?>
                    <tbody>
                        <?php
                        echo '<pre>';
                        $permission_categories = get_permissions();
                        
                        if ($permission_categories) {
                            foreach ($permission_categories as $permission) {
                        ?>
                                <tr style="background: #f0f1f3">
                                    <td style="width: 14%;"><?= $permission->permission_name ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                                $first_level_permissions = get_permissions($permission->id);
                                
                                if ($first_level_permissions ) {
                                    $i = 1;
                                    foreach ($first_level_permissions as $first_level_permission) {
                                        $second_level_permissions = get_permissions($first_level_permission->id);
                                        $have_permission = (check_permission($granted_permissions, $first_level_permission->permission_slug));
                                ?>
                                        <tr class="first_level_permission_row" id="<?= $first_level_permission->id ?>">
                                            <td><?= $i++ ?></td>
                                            <td><?= $first_level_permission->permission_name ?> <?php echo (!$have_permission && check_partial_permissions($catID, $second_level_permissions)) ? '<small style="color:blue">(Partial Permissions Allowed)</small>' : '' ?> </td>
                                            <td>
                                                <input type="checkbox" id="check-<?= $first_level_permission->id ?>" onchange="change_permission(<?= $catID ?>,<?= $first_level_permission->id ?>)" name="alert_banner" value="1" class="checksize permissions_checkbox" <?= ($have_permission) ? 'checked' : '' ?>>
                                            </td>
                                            <td data-toggle="collapse" aria-expanded="false" data-target="#<?= $first_level_permission->permission_slug ?>" class="accordion-toggle">
                                                <?php if ($second_level_permissions) {
                                                ?>
                                                    <i class='fas fa-chevron-up'></i>
                                                    <i class='fas fa-chevron-down'></i>
                                                <?php
                                                } ?>
                                            </td>
                                        </tr>
                                        <?php

                                        if ($second_level_permissions) {
                                        ?>
                                            <tr>
                                                <td colspan="12" class="hiddenRow">
                                                    <div class="accordian-body collapse" id="<?= $first_level_permission->permission_slug ?>">
                                                        <table class="table table-striped">
                                                            <tbody style="background: #e5f3ff;">
                                                                <?php
                                                                $j = 1;
                                                                foreach ($second_level_permissions as $second_level_permission) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $j++ ?></td>
                                                                        <td style="width: 25%;"><?= $second_level_permission->permission_name ?></td>
                                                                        <td><input <?= (check_permission($granted_permissions, $first_level_permission->permission_slug)) ? 'disabled' : '' ?> type="checkbox" id="check-<?= $second_level_permission->id ?>" name="alert_banner" onchange="change_permission(<?= $catID ?>,<?= $second_level_permission->id ?>)" value="1" class="checksize permissions_checkbox permissions_checkbox_child child_for_<?= $first_level_permission->id ?>" <?= (check_permission($granted_permissions, $second_level_permission->permission_slug)) ? 'checked' : '' ?>></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                        <?php
                                        }
                                    }
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <br>
                <div class="form-footer-buttons">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="<?= url('businessinfo?block=permissions') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                   
                </div>

            </form>
        </div>
    </div>
    <!--Row-->
</div>

@endsection('content')
<script>
    function change_permission(role_id, permission_id) {
        var status = $('#check-' + permission_id).prop('checked');
        $(".child_for_" + permission_id).prop('checked',status);
        if (status) {
            var checked = 1;
            $(".child_for_" + permission_id).attr("disabled", true);
        } else {
            $(".child_for_" + permission_id).removeAttr("disabled");
            var checked = 0;
        }
        $(".child_for_" + permission_id).trigger('change');
        $.ajax({
            url: '<?= url('change_permission'); ?>',
            type: "POST",
            data: {
                role_id: role_id,
                permission_id: permission_id,
                status: checked,
                _token: "{{ csrf_token() }}"
            }
        });
    }

    function toggle_all_permissions(role_id) {
        var status = $('#toggle_all').prop('checked');
        
        $('.first_level_permission_row').find('small').hide();
        if (status) {
            var checked = 1;
            $('.permissions_checkbox').prop('checked', true);
            $('.permissions_checkbox_child').attr("disabled", true);
        } else {
            var checked = 0;
            $('.permissions_checkbox').prop('checked', false);
            $('.permissions_checkbox_child').attr("disabled", false);
        }

        $.ajax({
            url: '<?= url('toggle_all_permissions'); ?>',
            type: "POST",
            data: {
                role_id: role_id,
                status: checked,
                _token: "{{ csrf_token() }}"
            }
        });
    }
</script>
