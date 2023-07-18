<footer>
    <div class="row justify-content-center">
        <div class="col-lg-12 text-center text-green footer-logout">
            <?php
            if (preg_match("/site.php/", $uri) || preg_match("/blog.php/", $uri) ||  preg_match("/email.php/", $uri)) { ?>
            <div class="col"><a class="nav-link" href="/"><i class="icon"
                        data-feather="arrow-left-circle"></i>Logout</a>
            </div>
            <?php } else if ($uri == "/main") { ?>
            <p>Welcome Agent</p>
            <?php } ?>
        </div>
    </div>
</footer>
<!-- feather icon -->
<script src="../assets/js/feather.min.js"></script>
<!-- Data Table -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/js/bootstrap5-toggle.jquery.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script>
feather.replace()
</script>
<script src="../assets/js/footer.js"></script>
</body>

</html>