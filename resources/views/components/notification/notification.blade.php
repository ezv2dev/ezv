<script src="{{ asset('assets/js/errorToString.js') }}"></script>
@if ($errors->any())
    <script>
        alert(errorArrayToString(@json($errors->all())));
    </script>
@endif
