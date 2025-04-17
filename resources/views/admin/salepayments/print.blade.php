<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale Invoice</title>
    <style>

        body{
            background-color: #f5f6fa;
            font-family: "Inter", sans-serif;
            color: #666;
        }

        .heading{
            color: black;
            font-weight: 700;
        }

        .center{
            text-align: center!important;
        }

        .tm_container {
            max-width: 880px;
            padding: 30px 15px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            /* border: 1px solid; */
            /* background: white; */
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }


        /* ---------------------- Header --------------------------  */

            .logo{
                width: 100px
            }
            .invoice-header {
                background-color: #007aff;
                padding: 32px 28px;
                /* border-radius: 14px; */
            }

            .invoice-header > .row{
                display: flex;
                justify-content: space-between;
                align-items: center
            }

            .invoice-header .right p{
            margin: 0px;
            color: white;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5em;
            }

        /* ---------------------- Header --------------------------  */



        /* ---------------------- Customer Details ----------------  */

            .customer-section{
                background: white;
                padding: 19px 28px;
            }

            .customer-section > .row{
                display: flex;
                justify-content: space-between;
                /* align-items: center */
            }

            .customer-section h3{
                line-height: 1.5em;
                margin: 5px 0px;
            }

            .customer-section h4{
                margin: 0px;
                font-size:13px;
                padding: 0px 2px;
            }

            .customer-section p{
                margin: 0px;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.5em;
                padding: 0px 2px;
            }

            .order-info > div{
                display: flex;
                /* justify-content: space-between; */
                align-items: center;
            }

        /* ---------------------- Customer Details --------------------------  */

        
        /* ---------------------- Order Section -----------------------------  */

            .order-section{
                background: white;
                padding: 0px 16px;
            }

            .order-section table{
                width: 100%;
                border-collapse: collapse;
            }

            .order-section th{
                border: 1px solid rgba(255, 255, 255, 0.231372549);
                color: #fff;
                background-color: #007aff;
                /* width: 41.66666667%; */
                text-align: center;
                font-weight: 600;
                padding: 10px 15px;
                font-size: 14px;
                line-height: 1.55em;
                text-align: left;
                font-family: "Inter", sans-serif;
            }

            .order-section td{
                border: 1px solid #dbdfea;
                padding: 10px 15px;
                line-height: 1.55em;
                font-size: 14px;
            }

            .customer-section p{
                margin: 0px;
                font-family: "Inter", sans-serif;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.5em;
            }

            .table-footer{
                display: flex;
                justify-content: space-between;
            }

        /* ---------------------- Order Section --------------------------  */



        @media print {

            .button-box{
                display:none!important;
            }
        }

    </style>
</head>
<body>

    <div class="button-box"  style="text-align: center" >
        <a class="btn" style="color: white;background:red"  href="{{URL::to('admin/saleinvoices')}}">Back</a>
        <button class="btn" style="color: white;background:rgb(14, 185, 80)"  onclick="window.print()" >Download</button>
    </div>
    <div class="tm_container">

        <div class="invoice-header">
           <div class="row" >
              <div class="left">
                   <div class="logo">
                    <img style="50px;50px" src="{{asset('/uploads/'.$_s['logo'])}}" />
                   </div>
              </div>
              <div class="right">
                  <div class="company-details">
                        <div> 
                              <p>{{$_s['name']}}</p>
                              <p>Phone: {{$_s['contact']}}</p>
                              <p>Email: {{$_s['email']}}</p>
                              <p>{{$_s['street_address']}}</p>
                        </div>
                  </div>
              </div>
           </div>
        </div>

        <div class="customer-section">
            <div class="row">
               <div class="left order-info">
                    <h3  class="heading"  >Invoice To:</h3>
                    <div>
                        <h4 class="heading" >Fullname:</h4> 
                        <p>{{$sale->customer_name}}</p>
                    </div>
                    <div>
                      <h4 class="heading"  >Contact:</h4>
                      <p>{{$sale->customer_contact}}</p>
                    </div>
                    <div>
                      <h4 class="heading"  >Email:</h4>
                      <p>{{$sale->customer_email}}</p>
                    </div>
                    <div>
                        <h4 class="heading" >Country:</h4>
                        <p>{{$sale->customer_country}}</p>
                    </div>
                    <div>
                        <h4 class="heading" >State/Province:</h4>
                        <p>{{$sale->customer_state}}</p>
                    </div>
                    <div>
                        <h4  class="heading"  >City:</h4>
                        <p>{{$sale->customer_city}}</p>
                    </div>
                    <div>
                        <h4  class="heading" >Postal Code:</h4>
                        <p>{{$sale->customer_postalcode}}</p>
                    </div>
                    <div>
                        <h4  class="heading"  >Full Address:</h4>
                        <p>{{$sale->customer_address}}</p>
                    </div>
               </div>
               <div class="right order-info">
                    <h3  class="heading"  >Invoice Info:</h3>
                    <div class=""> 
                        <h4  class="heading" >Invoice No:</h4>
                        <p>#{{$sale->id}}</p>
                    </div>
                    <div class=""> 
                        <h4  class="heading" >Order Date: </h4>
                        <p>{{date('d-m-Y', strtotime($sale->date))}}</p>
                    </div>
                    @if($sale->due_date)
                    <div class=""> 
                        <h4  class="heading" >Due Date: </h4>
                        <p>{{date('d-m-Y', strtotime($sale->due_date))}}</p>
                    </div>
                    @endif
                    <div class=""> 
                        <h4  class="heading" >Payment Status: </h4>
                        <p>{{$sale->is_paid ? 'Paid' : 'Unpaid'}}</p>
                    </div>
               </div>
            </div>
        </div>

        <div class="order-section">
            <table class="tm_gray_bg">
                <thead>
                  <tr>
                    <th class="center">#</th>
                    <th class="center">Product</th>
                    <th class="center">Qty</th>
                    <th class="center">Price</th>
                    <th class="center">Total</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $k = 1; 
                    
                    ?>
                    @foreach ( $sale->items as $key => $item)
                        <tr>
                            <td class="center">{{$k}}</td>
                            <td>{{$item->product->sku}} - {{$item->product->title}} {{$item->description}}</td>
                            <td class="center">{{$item->quantity}}</td>
                            <td class="center">{{$item->price}}</td>
                            <td class="center">{{$item->total}}</td>
                        </tr>
                        <?php $k += 1; ?>
                    @endforeach
                </tbody>
              </table>
             <div class="table-footer">
                <div style="width: 100%;" > 
                    <p style="font-size: 14px" class="heading">Additional Details</p>
                    <p style="font-size: 13px;padding:0px 3px;" >{{$sale->notes}}</p>
                </div>
                <div style="width: 496px;" >
                    <table>
                        <tbody>
                           <tr>
                               <td style="text-align: center" class="heading">Subtotal</td>
                               <td style="text-align: center" class="">{{$sale->subtotal}}</td>
                           </tr>
                           @foreach( json_decode($sale->adjustments) ?? [] as $k => $a)
                           <tr>
                               <td style="text-align: center" class=" heading">{{$a->title ?? ' '}} ({{$a->operator ?? ' '}})</td>
                               <td style="text-align: center" class="">{{$a->value ?? ' '}} </td>
                           </tr>
                           @endforeach
                           <tr>
                               <td style="text-align: center" class="heading">Grand Total</td>
                               <td style="text-align: center" class="">{{$sale->grandtotal}}</td>
                           </tr>
                        </tbody>
                     </table> 
                </div>
             </div>              
          </div>
      </div>
   </body>
</html>