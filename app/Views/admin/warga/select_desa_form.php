<select class="form-select selectDesa" name="desa_id" style="width: 100%;">
    <option value="">Pilih Desa</option>
    <?php foreach($desas as $desa):?>
    <option value="<?=$desa->desa_id?>" <?=($_POST['desa_id'] ?? '') == $desa->desa_id?'selected':''?>><?=$desa->desa_nama?></option>
    <?php endforeach?>
</select>
<div class="errorApi errorApi_desa_id invalid-feedback"></div>

<script>
    $(document).ready(function () {
        $('.selectDesa').select2();
    })
</script>