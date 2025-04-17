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
                    <img style="50px;50px" src="{{asset('/uploads/'.$_s['logo'])}}" alt="" srcset="">
                    {{-- <svg width="104" height="79" viewBox="0 0 104 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M63.9201 52.2119H39.4899L51.7049 32.7689L63.9201 52.2119ZM67.7888 7.16767L96.0871 52.2119H68.4239L53.9563 29.1848L67.7888 7.16767ZM102.97 56L67.7888 1.19209e-06L51.7049 25.6012L35.6211 1.19209e-06L1 55.107H5.50326L35.6211 7.16767L49.453 29.1848L32.6068 56H102.97Z" fill="#fff"/>
                        <path d="M2.99432 62.6364V75H1.49716V62.6364H2.99432ZM15.8002 62.6364V75H14.3513L7.61408 65.2926H7.49334V75H5.99618V62.6364H7.44505L14.2064 72.3679H14.3271V62.6364H15.8002ZM19.3031 62.6364L22.9735 73.044H23.1184L26.7889 62.6364H28.3585L23.8187 75H22.2733L17.7335 62.6364H19.3031ZM40.135 68.8182C40.135 70.1222 39.8996 71.2491 39.4287 72.1989C38.9578 73.1487 38.3119 73.8812 37.4909 74.3963C36.6698 74.9115 35.7321 75.169 34.6776 75.169C33.6232 75.169 32.6855 74.9115 31.8644 74.3963C31.0434 73.8812 30.3975 73.1487 29.9266 72.1989C29.4557 71.2491 29.2203 70.1222 29.2203 68.8182C29.2203 67.5142 29.4557 66.3873 29.9266 65.4375C30.3975 64.4877 31.0434 63.7552 31.8644 63.2401C32.6855 62.7249 33.6232 62.4673 34.6776 62.4673C35.7321 62.4673 36.6698 62.7249 37.4909 63.2401C38.3119 63.7552 38.9578 64.4877 39.4287 65.4375C39.8996 66.3873 40.135 67.5142 40.135 68.8182ZM38.6862 68.8182C38.6862 67.7476 38.5071 66.8441 38.1489 66.1076C37.7947 65.3711 37.3138 64.8137 36.7061 64.4354C36.1024 64.0571 35.4262 63.8679 34.6776 63.8679C33.9291 63.8679 33.2509 64.0571 32.6432 64.4354C32.0395 64.8137 31.5586 65.3711 31.2004 66.1076C30.8462 66.8441 30.6691 67.7476 30.6691 68.8182C30.6691 69.8887 30.8462 70.7923 31.2004 71.5288C31.5586 72.2653 32.0395 72.8227 32.6432 73.201C33.2509 73.5793 33.9291 73.7685 34.6776 73.7685C35.4262 73.7685 36.1024 73.5793 36.7061 73.201C37.3138 72.8227 37.7947 72.2653 38.1489 71.5288C38.5071 70.7923 38.6862 69.8887 38.6862 68.8182ZM42.6524 62.6364H44.4394L48.6411 72.8991H48.786L52.9877 62.6364H54.7746V75H53.374V65.6065H53.2533L49.3896 75H48.0374L44.1737 65.6065H44.053V75H42.6524V62.6364ZM58.2836 75H56.714L61.2537 62.6364H62.7992L67.339 75H65.7694L62.0748 64.5923H61.9782L58.2836 75ZM58.8631 70.1705H65.1898V71.4986H58.8631V70.1705ZM74.046 75V62.6364H75.5431V73.6719H81.2903V75H74.046ZM81.2888 63.9645V62.6364H90.5615V63.9645H86.6737V75H85.1766V63.9645H81.2888ZM96.6875 75H92.8722V62.6364H96.8565C98.0559 62.6364 99.0821 62.8839 99.9354 63.3789C100.789 63.8699 101.443 64.5762 101.897 65.4979C102.352 66.4155 102.58 67.5142 102.58 68.794C102.58 70.0819 102.35 71.1907 101.891 72.1204C101.433 73.046 100.764 73.7584 99.8871 74.2575C99.0097 74.7525 97.9432 75 96.6875 75ZM94.3693 73.6719H96.5909C97.6132 73.6719 98.4603 73.4747 99.1325 73.0803C99.8046 72.6858 100.306 72.1244 100.636 71.396C100.966 70.6675 101.131 69.8002 101.131 68.794C101.131 67.7959 100.968 66.9367 100.642 66.2163C100.316 65.4918 99.8287 64.9364 99.1808 64.5501C98.5328 64.1597 97.7259 63.9645 96.7599 63.9645H94.3693V73.6719Z" fill="#fff"/>
                        </svg> --}}
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
                    <h3  class="heading">Invoice To:</h3>
                    <div>
                        <h4 class="heading">Fullname:</h4> 
                        <p>{{$sale->customer->name}}</p>
                    </div>
                    <div>
                      <h4 class="heading">Contact:</h4>
                      <p>{{$sale->customer->phone}}</p>
                    </div>
                    <div>
                      <h4 class="heading">Email:</h4>
                      <p>{{$sale->customer->email}}</p>
                    </div>
                    <div>
                        <h4 class="heading" >Country:</h4>
                        <p>{{$sale->customer->country}}</p>
                    </div>
                    <div>
                        <h4 class="heading" >State/Province:</h4>
                        <p>{{$sale->customer->state}}</p>
                    </div>
                    <div>
                        <h4  class="heading"  >City:</h4>
                        <p>{{$sale->customer->city}}</p>
                    </div>
                    <div>
                        <h4  class="heading" >Postal Code:</h4>
                        <p>{{$sale->customer->postal_code}}</p>
                    </div>
                    <div>
                        <h4  class="heading"  >Full Address:</h4>
                        <p>{{$sale->customer->street_address}}</p>
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
                    <th class="center">Price</th>
                    <th class="center">Qty</th>
                    <th class="center">Discount</th>
                    <th class="center">Tax</th>
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
                            <td class="center">{{$item->price}}</td>
                            <td class="center">{{$item->quantity}}</td>
                            <td class="center">{{$item->discount}}</td>
                            <td class="center">{{$item->tax}}</td>
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