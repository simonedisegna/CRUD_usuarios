$(document).ready(function() {
    console.log('app.js carregado corretamente'); // Para teste
    // Inicializar DataTable
    var table = $('#usuariosListagem').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros no total)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            }
        },
        "initComplete": function() {
            this.api().columns().every(function() {
                var column = this;
                $('input', this.footer()).on('keyup change', function() {
                    if (column.search() !== this.value) {
                        column.search(this.value).draw();
                    }
                });
            });
        }
    });
});

function teste() {
    alert('Oi');
}
