<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="{{ asset('js/datatable.min.js') }}"></script>
<script>
    let targets = {{ $targets }};
    function initTable(){
        $('#{{ $tableid }}').DataTable( {
            pageLength: 5,
            lengthChange: false,
            searching: true,
            language: {
                zeroRecords: "Nenhum resultado encontrado",
                info: "Quantidade de postagens: _MAX_",
                infoEmpty: "Quantidade de postagens: _MAX_",
                search: '',
                searchPlaceholder: 'Pesquise...',
                paginate: {
                    previous: 'Anterior',
                    next: 'Próximo'
                },
                infoFiltered: '(Quantidade de postagens: _MAX_)',
                zeroRecords: 'Nada foi encontrado.',
            },
            columnDefs: [
                { targets: targets, orderable: false }
            ],
        });
    }
    initTable()
</script>
