 <!-- Modale inserimento tag -->
 <div class="modal fade modal-lg" id="tagsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inserisci un nuovo tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="{{ route('tag.insert') }}">
                <div class="modal-body">
                    @csrf                                    
                    <label for="tag">Tag:</label>
                    <input type="string" name="insert-tag" value="{{ !empty(old('insert-tag')) ? old('insert-tag') : '' }}"/>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>  
            </form>
        </div>
    </div>
</div>

<script type="module">
$(document).ready(function(){
    
});
</script>