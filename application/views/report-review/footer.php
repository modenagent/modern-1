                <!-- Javascript Files -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/report/app.js?v=0.20"></script>
                <script>
                        $('.humberger').click(() => {
                                if ($('ul.tab-head').hasClass('hide')) {
                                        $('ul.tab-head').removeClass('hide');
                                        $('ul.tab-head').addClass('show');
                                } else {
                                        $('ul.tab-head').removeClass('show');
                                        $('ul.tab-head').addClass('hide');
                                }
                        })
                </script>
        </body>
</html>