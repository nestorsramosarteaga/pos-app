/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// Obtener el idioma de la página
let lang = document.documentElement.lang || 'en'; // Si no hay lang, se asume 'en'

const langJson = {
    es: 'js/es.json',
    en: 'js/en.json',
    fr: 'js/fr.json'
};

async function loadTranslations(lang) {
    try {
        let response = await fetch(langJson[lang]);
        if (!response.ok) {
            throw new Error(`Error al cargar el archivo de traducción para el idioma: ${lang}`);
        }
        let data = await response.json();
        console.log(`Traducciones cargadas para el idioma: ${lang}`);
        return data;
    } catch (error) {
        console.error('Error al cargar las traducciones:', error);
        return null;
    }
}

async function initializeDataTable(datatablesSimple) {
    let translations = await loadTranslations(lang);
    let options = {};

    if (translations) {
        options = {
            labels: translations.labels
        };
    }

    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, options);
    }
}



