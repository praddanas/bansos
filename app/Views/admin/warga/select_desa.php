<select class="form-select selectDesa" name="desa_id" style="width: 100%;">
    <option value="-1">Semua Desa</option>
    <?php foreach($desas as $desa):?>
    <option value="<?=$desa->desa_id?>"><?=$desa->desa_nama?></option>
    <?php endforeach?>
</select>

<script>
    $(document).ready(function () {
        $('.selectDesa').select2();
        $('.selectDesa').on('change', function () {
            getTable()
        })
    })
</script>