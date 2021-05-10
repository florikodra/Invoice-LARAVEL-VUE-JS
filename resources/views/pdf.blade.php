<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
             @font-face {
                font-family: 'Museo';
                src: url('/css/Museo-300.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            @page {
                margin: 0cm 0cm;
                margin-top: 2cm;
                margin-bottom: 2cm;
                font-family: 'Museo'; 
                font-weight: normal; 
                font-style: normal;
            }
            @page:remaining{
                .header{
                    display: none!important;
                }
            }
            /* @font-face{
                font-family: Verdana!important; 
              
            } */
            /* @font-face {
                font-family: "Museo";
                font-weight: normal;
                font-style: normal; 
                src: url("//db.onlinewebfonts.com/t/cb9fcef8c3162a98851f65872ec99f11.eot"); 
                src: url("//db.onlinewebfonts.com/t/cb9fcef8c3162a98851f65872ec99f11.eot?#iefix") format("embedded-opentype"), 
                url("//db.onlinewebfonts.com/t/cb9fcef8c3162a98851f65872ec99f11.woff2") format("woff2"), 
                url("//db.onlinewebfonts.com/t/cb9fcef8c3162a98851f65872ec99f11.woff") format("woff"), 
                url("//db.onlinewebfonts.com/t/cb9fcef8c3162a98851f65872ec99f11.ttf") format("truetype"), 
                url("//db.onlinewebfonts.com/t/cb9fcef8c3162a98851f65872ec99f11.svg#Museo") format("svg"); 
                
                } */
           /*  @font-face {
                font-family: Museo;
                src: url({{storage_path('fonts/Museo300-Regular.otf')}}) format("opentype");
            } */
            

            
            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
                font-family: 'Museo'; 
                font-weight: normal; 
                font-style: normal;
            }

            /** Define the header rules **/
            .header {
                position: absolute;
                top: -2cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
                z-index: 4;
                /* margin-bottom: 4cm; */
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: -2cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
            .container{
                margin-top: 1cm;  
                margin-left: 1.5cm!important;
                margin-right: 1.5cm!important;
            }
            .backg-c{
                background-color: #1aafff;
            }
            .under-fattura{
                border-radius: 10px;
            }
            .color-c{
                color: #1aafff;
            }
            .companyclient{
                font-size: 13px;
                font-family: 'Museo';
            }
            .title{
                font-size: 34px;
                font-family: "Museo";
                font-weight: normal;
                opacity: .8;
                
            }
            .iva-c{
                font-size: 13px!important;
                text-align: right!important;
            }
            .totale-c{
                font-size: 18px!important;
                font-family: "Museo"!important;
                text-align: center!important;
                padding: 0!important;
                margin: 0!important;
            }
            .arrow-down {
                border-left: 8px solid transparent;
                border-right: 8px solid transparent;
                border-top: 8px solid #ffffff;
            }
            table, td, th, tr, span, b {
                padding-top: 0px!important;
                padding-bottom: 0px!important;
                margin-top: 0px!important;
                margin-bottom: 0px!important;
                margin: 0;
                font-family: 'Museo'!important; 
                font-weight: normal; 
                font-style: normal;
            }
            /* .font-custom{
                font-family: Helvetica!important;
            } */
            /* .leftpad{
                
            } */

        </style>
   {{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/app.css"> --}}

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{ public_path("/css/bootstrap.css") }}">

</head>
    <body>
        <div class="header">
            <img src="{{ public_path("/pdf-header.jpg") }}" width="100%" height="100%"/>
        </div>

        <footer>
            <img src="{{ public_path("/pdf-footer.jpg") }}" width="100%" height="100%"/>
        </footer>

        <main>
            <div class="container" >
                <div class="row mb-1 mt-5">
                    <div class="col-md-4 text-secondary companyclient"><p>
                        {!! nl2br(e($invoice->company)) !!}
                        </p>
                    </div>
                    <div class="col-md-4 text-right float-right text-secondary companyclient">
                        {!! nl2br(e($invoice->reference_person)) !!}
                    </div>
                </div>
                <span class="text-secondary mb-3 font-custom title">Fattura <?php $PAGE_NUM ?></span>
                <div class="col-md-6" style="z-index: 1; margin-bottom: -1px">
                        <table>
                            <thead>
                                <tr>
                                <td>
                                    <div style="border-radius: 100%; border: 2px solid rgb(165, 165, 165);  padding: 6px; margin-left: -10px">
                                        <img src="{{ public_path("/calendar.png") }}" alt="" width="20px" height="20px" >
                                    </div>
                                    <span class="pic arrow-down"></span>
                                </td>
                                <td style="padding-left: 69px">
                                     <div style="border-radius: 100%; border: 2px solid rgb(165, 165, 165);  padding: 6px; margin-left: -10px;">
                                        <img src="{{ public_path("/barcode.png") }}" alt="" width="20px" height="20px">
                                    </div>
                                    <span class="pic arrow-down"></span>
                                </td>
                            </tr>
                            </thead>
                        </table>
                </div>
                
                <div class="col-md-6 backg-c text-white pt-2 pl-1 pr-2">
                    <div class="col-md-12">
                        <table>
                            <thead>
                                <tr>
                                    <td>
                                        Data:
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        Numero fattura:
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="-webkit-text-stroke: 2px rgb(255, 255, 255);">
                                        {{$invoice->date}}
                                    </th>
                                    <th></th>
                                    <th>
                                        {{$invoice->reference_number}}
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
                <div class="col-lg-12 mt-3 col-sm-12">
                    <div class="table-responsive row">
                        <table class="table table-striped" style="margin-left:-2cm;">
                            <thead class="color-c" style="border-top: 2px solid white;">
                                <tr>
                                    <td scope="col" style="width:50%; padding-left: 2cm;">Descrizione</td>
                                    <td scope="col" class="text-right">Prezzo</td>
                                    <td scope="col" class="text-center">Quantità</td>
                                    <td scope="col" class="text-right">Totale</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr style="font-size: 12px; ">
                                        <td style="width:50%; padding-left: 2cm"><b style="font-family: 'Museo'!important; font-weight: normal; padding-top: 0px">{{$item->title}}</b><br><small class="class="text-secondary" ">{{$item->description}}</small></td>
                                        <td class="text-right text-secondary">
                                            @if(!$item->fixed)
                                            <b class="float-left">{{$invoice->currency}}</b> {{number_format($item->price,2,',', ' ')}}
                                            @endif
                                        </td>
                                        <td class="text-center text-secondary">
                                        @if($item->fixed)
                                            forfait
                                        @else
                                            {{$item->quantity}}
                                        @endif
                                        </td>
                                        <td class="text-right text-secondary"><b class="float-left">{{$invoice->currency}}</b> {{number_format($item->total,2,',', ' ')}}</td>
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>

               {{--  <div class="col-md-12 float-right pr-4">
                    <div class="col-lg-4 col-sm-12 col-md-4 pl-2 pr-2 text-lg-center text-sm-center">
                        <div class="row">
                            <div class="row col-7 mb-2">
                                <h5 class="mt-2">IVA </h5>
                            </div>
                            <div class="col-2">
                                <h5 class="mt-2">{{$invoice->tax}} </h5>
                            </div>
                            <div class="col-3">
                                <h5 class="mt-2">{{$invoice->total-$invoice->subtotal}}</h5>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row" >
                    <div class="col-md-6 offset-md-6">
                        <table class="table" style="border-top: 2px solid white; padding-top: 0px; margin-top: 0px">
                            <tr  class="text-secondary iva-c" style="line-height:5px;">
                                <td width="95px" class="text-left">
                                    Totale Parziale:
                                </td>
                                <td width="30px">
                                    {{$invoice->currency}}
                                </td>
                                <td width="100px">
                                    {{number_format($invoice->subtotal,2,',', ' ')}}
                                </td>
                            </tr>
                            <tr class="text-secondary iva-c"  style="line-height:5px;">
                                <td class="text-left">
                                    IVA ({{$invoice->tax}}%)
                                </td>
                                <td>
                                    {{$invoice->currency}}
                                </td>
                                <td>
                                    {{number_format($invoice->total-$invoice->subtotal,2,',', ' ')}}
                                </td>
                            </tr>
                            <tr class="backg-c text-white totale-c" style="line-height: 13px" >
                                <th class="text-left">
                                    Totale
                                </th>
                                <th>
                                    {{$invoice->currency}}
                                </th>
                                <th class="text-right">
                                    {{number_format($invoice->total,2,',', ' ')}}
                                </th>
                            </tr>
                        </table>
                           
                    </div>
                    
                </div>
                <div class="row">
                    <table class="col-md-12" height="100%">
                        <tr>
                            <td class="companyclient" style="width: 54%">
                                <span style="color:#202020">Coordinate bancarie</span><br>
                                   <span class="text-secondary"> Street 2<br>
                                    IBAN: USFD4543345g2222<br>
                                    CORPORATE<br>
                                    Bank - Street - New York<br>
                                    55558 New York
                                   </span>
                            </td>
                            <td class="companyclient align-top">
                                <span style="color:#202020">Grazie per la vostra fiducia e cordiali saluti. CORPORATE</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="companyclient text-secondary">Eventuali reclami sono da inoltrare entro 10 giorni dalla data della fattura.</td>
                        </tr>
                    </table>
                   
                </div>
            </div>
            
            
        </main>
    </body>
</html>
