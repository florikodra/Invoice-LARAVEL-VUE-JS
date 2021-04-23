<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
                margin-top: 2cm;
                margin-bottom: 2cm;
            }
            @page:remaining{
                .header{
                    display: none!important;
                }
            }
          
            
            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
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
                margin-top: 2cm;  
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

        </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
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
                <div class="row mb-5 mt-5">
                    <div class="col-md-4 text-secondary"><p>
                        {!! nl2br(e($invoice->company)) !!}
                        </p>
                    </div>
                    <div class="col-md-4 text-right float-right text-secondary">
                        {!! nl2br(e($invoice->reference_person)) !!}
                    </div>
                </div>
                <h2 class="text-secondary mb-3 font-weight-bold">Fattura <?php $PAGE_NUM ?></h2>
                <div class="col-md-4 backg-c text-white pt-2 pb-2 pl-4 pr-4 under-fattura">
                    <div class="col-md-12">
                        <div>
                            <b>Data:</b> {{$invoice->date}}
                        </div>
                        <div>
                            <b>Numero fattura:</b> {{$invoice->reference_number}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3 col-sm-12">
                    <div class="table-responsive row">
                        <table class="table table-striped">
                            <thead class="color-c font-weight-bold">
                                <tr>
                                    <th scope="col" style="width:50%">Descrizione</th>
                                    <th scope="col" class="text-right">Prezzo</th>
                                    <th scope="col" class="text-center">Quantità</th>
                                    <th scope="col" class="text-right">Totale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr style="font-size: 12px">
                                        <td class="text-secondary"><b>{{$item->title}}</b><br><small>{{$item->description}}</small></td>
                                        <td class="text-right text-secondary">
                                            @if(!$item->fixed)
                                            <b class="float-left">{{$invoice->currency}}</b> {{$item->price}}
                                            @endif
                                        </td>
                                        <td class="text-center text-secondary">
                                        @if($item->fixed)
                                            forfait
                                        @else
                                            {{$item->quantity}}
                                        @endif
                                        </td>
                                        <td class="text-right text-secondary"><b class="float-left">{{$invoice->currency}}</b> {{$item->total}}</td>
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
                
                
                <div class="col-md-4 backg-c text-white float-right under-fattura">
                    <div class="col-md-12 pt-2 text-center">
                                <h6>IVA ({{$invoice->tax}}%) {{$invoice->currency}} <b>{{number_format($invoice->total-$invoice->subtotal,2)}}</b></h6>
                        </div>
                    <div class="col-md-12 text-center">
                                <h4>Totale {{$invoice->currency}} <b>{{$invoice->total}}</b></h4>
                        </div>
                </div>
           
            </div>
            
            
        </main>
    </body>
</html>
