    <script src="<?php echo $root; ?>/res/bootstrap/assets/js/jquery.js"></script>
    <script src="<?php echo $root; ?>/res/bootstrap/dist/js/bootstrap.min.js"></script>
        <?php if ($session->get('num') === 0 ): ?>
        <script type="text/javascript" src="<?php echo $root; ?>/res/js/start.js"></script>
        <?php endif; ?>
        <?php if (! $session->get('last')) : ?>
        <script type="text/javascript" src="<?php echo $root; ?>/res/js/form.js"></script>
        <?php endif; ?>
    <script type="text/javascript" src="<?php echo $root; ?>/res/js/general.js"></script>
</body>
</html>
