<script id="pic-upload-template" type="text/x-jquery-tmpl">
<div class="pic-upload-box">
    <div class="row">
        <label for="picUpload_${id}">��Ʒ�ϴ�:</label>
        <div class="form-widget pic-upload-box">
            <a href="javascript:return void();" class="del-pic-btn">ɾ��</a>
            <input type="file" name="picUpload[]" id="picUpload_${id}" class="picUpload" />
        </div>
    </div>
    <div class="row">
        <label for="picName_${id}">��Ʒ����:</label>
        <div class="form-widget">
            <input type="text" name="picName[]" id="picName_${id}" class="text picName" />
        </div>
    </div>
    <div class="row">
        <label for="picDescription_${id}">��Ʒ����:</label>
        <div class="form-widget">
            <textarea name="picDescription[]" id="picDescription_${id}" cols="30" rows="10" class="description picDescription"></textarea>
        </div>
    </div>
</div>
</script>