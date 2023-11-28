@extends('adm.template.layout')
@section('title', 'Acompanhe - Criar')

@section('content')

    @include('adm.includes.error')

    <div class="content">
        <form action="{{ route('acompanhe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="title">Título</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Título" maxlength="100" value="{{ old('title') }}" required>
                        <span id="titlechars" class="form-text">100</span><span class="form-text"> Caracteres restantes</span>
                    </div>
                    <div class="col">
                        <label class="form-label" for="author">Autor</label>
                        <input class="form-control" type="text" name="author" id="author" placeholder="Autor" value="{{ old('author') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="subtitle">Resumo</label>
                <textarea class="form-control" type="text" name="subtitle" id="subtitle" rows="3" class="form-control " maxlength="255" required>{{ old('subtitle') }}</textarea>
                <span id="subtitlechars" class="form-text">255</span><span class="form-text"> Caracteres restantes</span>
            </div>

            <div class="form-group">
                <div class="row" id="image-section">
                    <div class="col">
                        <div class="col">
                            <label class="form-label" for="type">Tipo da postagem</label>
                            <select onchange="changeOptions(this)" class="form-control" name="type" id="type">
                                <option id="opTexto" value="texto" selected>Texto</option>
                                <option id="opVideo" value="video">Vídeo</option>
                            </select>
                        </div>
                        <div class="col col-image">
                            <label class="form-label" for="image">Imagem</label>
                            <input class="form-control" type="file" name="image" id="inputImage" onchange="PreviewImage();">
                            <span class="text-danger">Obs: formatos recomendados (.jpg .png) com 72dpi e tamanho maximo de 5MB</span>
                            <span style="display: flex; color: #b22; ">Obs: Resolução de imagem recomendada:&nbsp;<strong>800 x 400</strong></span><br>
                            <input type="checkbox" name="converter" id="converter" checked>
                            <label class="form-label" for="converter"> Converter a imagem para .webp </label>
                            <div class="explanation">
                                <em>
                                <p>Mantenha selecionada essa opção para converter sua imagem para um formato mais otimizado e mais leve.</p>
                                </em>
                            </div>
                        </div>
                        <div class="col col-video">
                            <label class="form-label" for="video">Vídeo</label>
                            <p>*Obs. coloque somente o conteúdo da URL que está em vermelho.
                                <br>
                                Exemplo: https://www.youtube.com/watch?v=<strong style="color: red;">CPRx_WVkJ8g</strong>
                            </p>
                            <input maxlength="11" id="uploadVideo" onkeyup="CountCaracters($(this).val().length, 'video')" class="form-control" type="text" name="video" style="display: block"/>
                        </div>

                    </div>
                    <div class="col">
                        <img src="{{ asset('upload/acompanhe/notfound.png') }}" width="100%" id="uploadPreviewImage" alt="">
                        <iframe class="iframe-video" id="uploadPreviewVideo" width="100%" height="100%" src=" " frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="text">Conteúdo</label>
                <textarea class="ckeditor form-control" id="ckeditor" name="text" required>{{ old('author') }}</textarea>
            </div>
            <br>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input publicar-agora" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="publicar-agora" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Publicar agora
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input agendar" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Agendar publicação
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-agendamento disable">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="date">Data</label>
                        <input class="form-control" type="date" name="date" value="{{ old('date') }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="time">Horário</label>
                        <input class="form-control" type="time" name="time" value="{{ old('time') }}">
                    </div>
                </div>
            </div>
            <br>
            <div class="group-button">
                <input class="btn btn-success" type="submit" value="Cadastrar">
                <a href="{{ route('acompanhe.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    @include('adm.acompanhe.create-edit-scripts')
@endsection
