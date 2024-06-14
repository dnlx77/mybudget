<!-- Modale edit tags -->
<form enctype="multipart/form-data" method="post" action="{{ route('tag.edit') }}">
    <div class="modal fade modal-lg" id="tagsEditModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifica un tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                    <div class="modal-body">
                        @csrf                            
                        <input type="hidden" name="edit_tag_id" />        
                        <label for="tag">Tag:</label>
                        <input type="string" name="edit-tag" value="{{ !empty(old('edit-tag')) ? old('edit-tag') : '' }}"/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>  
            </div>
        </div>
    </div>
</form>


<script type="module">
    $(document).ready(function(){
        
        $('.modale-tag-edit').on('click', (function() {
            $("[name='edit_tag_id']").val($(this).attr('data-id-tag'));
            $.ajax({
                url:"/tags/" + $(this).attr('data-id-tag') + "/services/get-tag",
                method:"GET",
                data:{},
                dataType: 'json',
                success:function(result) {
                    console.log(result.nome);
                    $("[name='edit-tag']").val(result.nome);
                },
                error:function() {
                    console.log();
                }
            });
        }));
        
    });
</script>