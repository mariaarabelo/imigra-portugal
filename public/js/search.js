// Adicione um script ao seu arquivo Blade ou a um arquivo JS externo, dependendo de sua preferência.

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.search-bar form');
  
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(searchForm);
        const query = formData.get('query');
  
        fetch(`{{ url('/') }}?query=${query}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
        .then(response => response.json())
        .then(data => {
            // Atualize a parte da página que exibe os resultados da pesquisa
            // Aqui você pode usar JavaScript para manipular a exibição dos resultados.
        })
        .catch(error => console.error('Error:', error));
    });
  });
  