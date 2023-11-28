@extends('adm.template.layout')
@section('title', 'Seo')

@section('content')
<div class="content">
   
    @include('adm.includes.messages')

    <div class="info">
        <div class="info">
            <h1>SEO Avançado</h1>
            <span style="color:red;">Atenção: Caso não tenha experiência com XML ou SITEMAP, não mexa nas configurações.<br>Somente anexe um sitemap.xml caso não haja nenhum sitemap anexado em seu website.
            </span>
            <br>
            <hr>
            <span>Caso não exista nenhum sitemap anexado ao seu website, favor anexar o mesmo seguindo a estrutura abaixo.</span><br>
            <span>
                Por padrão o header do seu xml será semelhante ao código abaixo. <span style="color:red;">( O header é gerado automaticamente não é necessário inseri-lo no seu arquivo XML )</span>
                <pre>                        &lt;?xml version="1.0" encoding="UTF-8"?&gt;
                    &lt;urlset
                        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"&gt;
                    &lt;!-- XML Gerado por: ADM --&gt;
                    </pre>                </span>
            <span>O sitemap.xml que você deve anexar tem de seguir a estrutura abaixo.</span>
            <span>
                <pre>                        &lt;url&gt;
                    &lt;loc&gt;https://www.seusite.com.br/&lt;/loc&gt;
                    &lt;lastmod&gt;2021-08-30T20:11:36+00:00&lt;/lastmod&gt;
                    &lt;priority&gt;1.00&lt;/priority&gt;
                    &lt;/url&gt;
                    &lt;url&gt;
                    &lt;loc&gt;https://www.seusite.com.br/quem-somos&lt;/loc&gt;
                    &lt;lastmod&gt;2021-08-30T20:11:36+00:00&lt;/lastmod&gt;
                    &lt;priority&gt;0.80&lt;/priority&gt;
                    &lt;/url&gt;
                    </pre>                </span>
            <form action="{{ route('seo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlFile1">Anexar sitemap XML</label>
                    <input type="file" name="sitemap" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <button type="submit" class="btn btn-primary">Enviar sitemap</button>
            </form>
        </div>
    </div>
</div>

@endsection