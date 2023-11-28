<script>
    $(document).on('click', '.delete-item', function(e) {
        e.preventDefault();
        let id = $(this).data('item-id');

        $.ajax({
            type: 'DELETE',
            url: '{{ route($route.".destroy") }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                ids: [id],
            },
            success: function(res) {
                $('#table').html(res);
                const deleteMessage = document.querySelector('.message-delete');
                $('.modal').modal('hide');
                $('.modal-backdrop').hide();
                deleteMessage.style = "opacity: 1;";
                deleteMessage.style = "display: flex;";
                setTimeout(() => { ocultMessageContent(deleteMessage) }, 3000);
                checkboxesIds = [];
                attachCheckboxEventListeners();
                initTable();
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
</script>
