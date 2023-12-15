 <!-- Modale inserimento operazioni -->
 <div class="modal fade modal-lg" id="operazioniModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inserisci una nuova operazione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form enctype="multipart/form-data" method="post" action="{{ route('operazione.insert') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="col">
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
                                <input type="number" name="importo" step="any" value="{{ !empty(old('importo')) ? old('importo') : (!empty($operazione->importo) ? $operazione->importo : '') }}"/>
                            </div>
                            <div class="row">
                                <label for="data_operazione">Data operazione:</label>
                                <input type="text" class="form-control" name="data_operazione" value="{{ !empty(old('data_operazione')) ? old('data_operazione') : (!empty($operazione->data_operazione) ? $operazione->data_operazione : '') }}"/>
                            </div>
                            <div class="row">
                                <label for="tags_select">tags:</label>
                                <select name="tags[]" id="tags_select" multiple="multiple" class="tag_select">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{ $tag->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="descrizione">Descrizione:</label>
                                <input type="text" name="descrizione" value="{{ !empty(old('descrizione')) ? old('descrizione') : (!empty($operazione->descrizione) ? $operazione->descrizione : '') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    
</body>

<script type="module">
    $(document).ready(function(){
        $('[name=data_operazione]').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            language: "it",
            weekStart: 1,
            maxViewMode: 3
            });
        
        $('#tags_select').select2({
            dropdownParent: $('#operazioniModal')
        });
        /*var tags_select_default = [{{ !empty(old('tags')) ? implode (',', old('tags')) : (!empty($tags_array) ? implode(',', $tags_array) : '')}}];
        $('#tags_select').val(tags_select_default).trigger('change');*/
    });
</script>