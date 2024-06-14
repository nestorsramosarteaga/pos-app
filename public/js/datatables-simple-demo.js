    window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    console.log(`El idioma de la página es: ${lang}`);

    // Inicializar la tabla de datos después de cargar las traducciones
    initializeDataTable(document.getElementById('datatablesSimple'));

});
