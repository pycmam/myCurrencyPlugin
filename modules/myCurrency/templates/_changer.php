<?php
/**
 * Выбор валюты
 */
?>

<script type="text/javascript">
jQuery(function(){
    jQuery('#my_currency').change(function(){
        document.location.href = "<?php echo url_for('myCurrency') ?>?currency=" + this.value;
    });
});
</script>

<select id="my_currency" name="currency">
<?php foreach ($items as $item): ?>
    <option value="<?php echo $item->getId() ?>"<?php echo $currentId == $item->getId() ? ' selected' : '' ?>>
    <?php echo $item ?>
    </option>
<?php endforeach ?>
</select>