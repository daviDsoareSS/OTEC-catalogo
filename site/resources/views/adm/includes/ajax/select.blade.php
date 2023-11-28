<script>
    // SCRIPT PARA MOSTRAR QUANTIDADE DE ITENS SELECIONADOS
    let checkboxesIds = []
    function attachCheckboxEventListeners() {
        const tableBody = document.querySelector('#table-body');
        const btnDeleteCheckboxes = document.querySelector('.btn-delete');
        btnDeleteCheckboxes.style.display = 'none';
        let quantidadeSelecionada = 0;

        tableBody.addEventListener('click', function(event) {
            if (event.target.tagName === 'INPUT' && event.target.type === 'checkbox') {
                let checkboxesClicked = document.querySelectorAll('input[type="checkbox"].clicked').length;

                if(event.target.classList.contains('clicked')) {
                    quantidadeSelecionada -= 1;
                }
                else {
                    quantidadeSelecionada += 1;
                }
                event.target.classList.toggle('clicked');

                if (!checkboxesIds.includes(event.target.value)) {
                    checkboxesIds.push(event.target.value);
                } else {
                    checkboxesIds = checkboxesIds.filter(id => id !== event.target.value);
                }

                if (quantidadeSelecionada > 1) {
                    btnDeleteCheckboxes.style.display = 'inline-block';
                    btnDeleteCheckboxes.innerHTML = 'Excluir ' + quantidadeSelecionada + ' itens  ' + '<i class="fa-solid fa-trash"></i>';
                } else {
                    btnDeleteCheckboxes.style.display = 'none';
                }
            }
        });
    }

    attachCheckboxEventListeners();

    function sendSelecteds() {
        $.ajax({
            type: 'GET',
            url: '{{ route($route.".selected") }}',
            data: {
                selectedIds: checkboxesIds,
            },
            success: function(res) {
                const modal = document.querySelector('.modal-body ul')
                const listItems = res.map(item => '<li>' + item["{{ $column }}"] + '</li>');
                const htmlContent = listItems.join('');

                modal.innerHTML = htmlContent;
            },
            error: function(error) {
                console.log(error)
            }
        })
    }
    $(document).on('click', '#btn-delete-all', function(e) {
        e.preventDefault();
        let itemId = [$(this).data('item-id')];
        let isDeleteAll = $(this).is('#btn-delete-all');

        $.ajax({
            type: 'delete',
            url: '{{ route($route.".destroy") }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: { ids: checkboxesIds },
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
                console.log(error);
            }
        });
    });
</script>
