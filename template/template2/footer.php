        <footer class="page-footer font-small bg-dark">
            <div class="footer-copyright text-white ml-3 py-3">© 2021
                <a class="text-white" href="index.php"> Research Library.</a>
                All Rights Reserved
            </div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
        <script>
            $(document).ready(function(){
                $("#btn-minus").click(function(){
                    $(".card-body-minus").toggle(200);
                });
            });
        </script>
    </body>

</html>