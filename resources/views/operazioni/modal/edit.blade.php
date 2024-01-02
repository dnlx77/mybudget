<!-- Modale inserimento operazioni -->
<form enctype="multipart/form-data" method="post" action="{{ route('operazione.edit') }}">
    <div class="modal fade modal-lg" id="operazioniEditModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifica un'operazione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="col">
                            @csrf
                            <input type="hidden" name="edit_operazione_id" />
                            <div class="row">
                                <div class="col-6">
                                    <select name="conto_partenza" id="partenza">
                                        @foreach ($lista_conti as $conto)
                                            <option value="{{ $conto->id }}">{{ $conto->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="conto_destinazione" id="destinazione">
                                        <option value="0">Trasferisci a...</option>
                                        @foreach ($lista_conti as $conto)
                                            <option value="{{ $conto->id }}">{{ $conto->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label for="importo">Importo:</label>
                                <input type="number" name="importo" step="any" value="{{ !empty(old('importo')) ? old('importo') : '' }}"/>
                            </div>
                            <div class="row">
                                <label for="data_operazione">Data operazione:</label>
                                <input type="text" class="form-control" name="data_operazione" value="{{ !empty(old('data_operazione')) ? old('data_operazione') : '' }}"/>
                            </div>
                            <div class="row">
                                <label for="tags_select">tags:</label>
                                <select name="tags[]" id="tags_select_edit" multiple="multiple" class="tag_select_edit">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{ $tag->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="descrizione">Descrizione:</label>
                                <input type="text" name="descrizione" value="{{ !empty(old('descrizione')) ? old('descrizione') : '' }}"/>
                            </div>
                        </div>
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
        $("[name='data_operazione']").datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            language: "it",
            weekStart: 1,
            maxViewMode: 3
        });

        $('#tags_select_edit').select2({
            dropdownParent: $('#operazioniEditModal')
        });
        /*var tags_select_default = [{{ !empty(old('tags')) ? implode (',', old('tags')) : (!empty($tags_array) ? implode(',', $tags_array) : '')}}];
        $('#tags_select_edit').val(tags_select_default).trigger('change');*/

        $('.modale-edit').on('click', (function() {
            $("[name='edit_operazione_id']").val($(this).attr('data-id-operazione'));
            $.ajax({
                url:"/operazioni/" + $(this).attr('data-id-operazione') + "/services/get-operazione",
                method:"GET",
                data:{},
                dataType: 'json',
                success:function(result) {
                    console.log(result);
                    //console.log($(this).attr('data-id-operazione'));
                    /*$(result).each(function(index, value) {
                        $("[name='importo']").val(value.importo);
                        $("[name='data_operazione']").val(value.data_operazione);
                        $("[name='descrizione']").val(value.descrizione);
                    });*/
                    $("[name='conto_partenza']").val(result.operazione.conto_id).trigger("change");
                    $("[name='importo']").val(result.operazione.importo);
                    $("[name='data_operazione']").val(result.operazione.data_operazione);
                    console.log($("[name='data_operazione']").val());
                    $("[name='descrizione']").val(result.operazione.descrizione);
                    $("#tags_select_edit").val(result.tags).trigger("change");
                },
                error:function() {
                    console.log();
                }
            });
        }));
        
    });
</script>