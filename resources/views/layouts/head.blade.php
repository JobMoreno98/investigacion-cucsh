<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-html5-3.0.2/datatables.min.css"
    rel="stylesheet">

<script src="{{ asset('js/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea', // change this value according to your HTML
        license_key: 'gpl'
    });
</script>
<style>
    [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active,
    [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active:hover,
    [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active:focus {
        background-color: #340185;
        color: #fff !important;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #1d0249;
        color: #fff;
    }
</style>
