<script>
    document.addEventListener("DOMContentLoaded", function() {


    });
    $(document).on('click', '.read_more_link', function() {
        var div_id = $(this).data('value');
        $(".read_more_link_" + div_id).hide();
        $(".read_less_link_" + div_id).show();
        $(".read_more_block_" + div_id).show();
    });

    $(document).on('click', '.read_less_link', function() {
        var div_id = $(this).data('value');
        $(".read_more_link_" + div_id).show();
        $(".read_less_link_" + div_id).hide();
        $(".read_more_block_" + div_id).hide();
    });
    $(document).ready(function() {
        // Function to fetch data for a specific event post
        function fetchData(postId, query = '', page = 1) {
            $.ajax({
                url: "{{ route('fetch.data.table') }}", // Adjust route as necessary
                method: 'GET',
                data: {
                    post_id: postId,
                    query: query,
                    page: page
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const tableBody = $('#table-body-' + postId);
                        tableBody.empty(); // Clear previous rows

                        // Loop through the data and append to the table
                        response.data.forEach((record, index) => {
                            const row = `
                            <tr>
                                ${ `<td class="col-span-1">${record.new === 1 ?'<div class="new-text" style="font-weight: bold;position:absolute; margin-left: -7px; margin-bottom: 5px;">New</div>':''}<div style="margin-left: 30px;">${record.comment}${record.text_popup}</div></td>`}
                                <td class="col-span-1">${record.name}</td>
                                <td class="col-span-1">${record.business}</td>
                                <td class="col-span-1">${record.attendance}</td>
                                <td class="col-span-1">${record.guest}</td>
                            </tr>
                        `;
                            tableBody.append(row);
                        });
                        document.querySelectorAll('.table-container').forEach(function(container) {
                            const tableBody = container.querySelector('tbody');
                            const table = container.querySelector('table');
                            const thead = container.querySelector('thead');
                            table.position = 'relative';
                            if (tableBody && tableBody.rows.length > 5) {
                                container.style.maxHeight = '230px'; // Adjust height as needed
                                container.style.overflowY = 'auto';
                                container.style.setProperty('--scrollbar-thumb', '#888'); // Thumb color
                                container.style.setProperty('--scrollbar-thumb-hover', '#555'); // Thumb color on hover
                                container.style.setProperty('--scrollbar-track', '#f1f1f1'); // Track color
                            }
                            const theadStyle = window.getComputedStyle(thead);

                            // Access the background color
                            const backgroundColor = theadStyle.backgroundColor;
                            const bodyBackground = window.getComputedStyle(document.body).backgroundColor;
                            if (thead) {
                                // Apply body's background color if not transparent, else set a default color
                                thead.style.backgroundColor = bodyBackground !== 'rgba(0, 0, 0, 0)' ? bodyBackground : '#ffffff';
                            }

                        });
                    } else {
                        // Handle the case where no data was found
                    }
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText); // Log errors to console for debugging
                }
            });
        }

        // Load initial data for each event post
        $('.event-post').each(function() {
            const postId = $(this).data('post-id');
            fetchData(postId); // Fetch data for each event post
        });

        // Search functionality for individual tables
        $('.search-input').on('keyup', function() {
            const value = $(this).val().toLowerCase(); // Get the input value
            const tableId = $(this).attr('data-table-id'); // Get the table id from the search input attribute
            const tbodyId = `#table-body-${tableId}`; // Create the tbody id based on the table id

            $(tbodyId + ' tr').filter(function() {
                // Check the text in the second column (second 'td', use ':eq(1)' to target the second td)
                $(this).toggle($(this).find('td:eq(1)').text().toLowerCase().indexOf(value) > -1);
            });
        });



        // Handle pagination links
    });
</script>