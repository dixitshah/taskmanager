$(document).ready(function () {
    $('#task-form').on('submit', function (e) {
        e.preventDefault();
        $('.error-msg').html('');

        let taskId = $('#task-id').val();
        let formData = $(this).serializeArray();
        if (taskId) {
            formData.push({ name: '_method', value: 'PUT' });
        }

        let url = taskId ? `/tasks/${taskId}` : storeUrl;

        $.ajax({
            url: url,
            type: 'POST', 
            data: formData,
            success: function (response) {
                toastr.success(taskId ? 'Task updated successfully!' : 'Task created successfully!');
                if (!taskId) $('#task-form')[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        $('#error-' + field).html(messages[0]);
                    });
                    toastr.error('Please fix the errors below.');
                } else {
                    toastr.error('Unexpected error. Try again.');
                }
            }
        });
    });


    $(document).on('click', '.edit-btn', function () {
        let taskId = $(this).data('id');

        $.ajax({
            url: `/tasks/${taskId}`,
            method: 'GET',
            success: function (task) {
                $('#task-id').val(task.id);
                $('input[name="title"]').val(task.title);
                $('select[name="category_id"]').val(task.category_id);
                $('input[name="due_date"]').val(task.due_date?.replace(' ', 'T'));
                $('select[name="status"]').val(task.status);
                $('select[name="priority"]').val(task.priority);
                $('textarea[name="description"]').val(task.description);
                toastr.info('Task loaded. Update the values and save.');
            },
            error: function () {
                toastr.error('Failed to load task.');
            }
        });
    });


    $(document).on('click', '.delete-btn', function () {
        let taskId = $(this).data('id');

        if (!confirm('Are you sure you want to delete this task?')) return;

        $.ajax({
            url: `/tasks/${taskId}`,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                toastr.success('Task deleted successfully!');
                $(`#task-row-${taskId}`).remove();
            },
            error: function () {
                toastr.error('Failed to delete task.');
            }
        });
    });
   
    // Category ,status , Search
    function fetchTasks() {
        let search = $('#task-search').val();
        let status = $('#task-status').val();
        let category = $('#task-category').val();
    
        $.ajax({
            url: '/tasks',
            type: 'GET',
            data: {
                search: search,
                status: status,
                category_id: category
            },
            success: function (response) {
                $('#task-list').html(response);
            },
            error: function () {
                toastr.error('Failed to load tasks.');
            }
        });
    }
    
    
    

    $('#task-search').on('keyup', fetchTasks);
    $('#task-status').on('change', fetchTasks);
    $('#task-category').on('change', fetchTasks);
    

});
