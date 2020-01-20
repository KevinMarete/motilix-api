<html>
<head>
</head>
<body  style="font-family: monospace;">
  <main>
    <div>
      Dear {{$order->user->firstname}},
      <br/>
      <br/>
      See below the details for your device order. 

    </div>

    <table style="width: 100%;font-size: smaller;border: 1px solid #c0c0c0;"  cellspacing="0">
      <tbody>
        <tr style="border-bottom: : 1px solid #c0c0c0;">
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" colspan="3"  height="30">
            <span style="text-decoration: underline;">
              <strong>
                <span style="color: #092d50; font-size: x-large; text-decoration: underline;">Device activation</span>
              </strong>
            </span>
          </td>
        </tr>
        <tr>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" colspan="1"  bgcolor="#ffffff" height="20">
            <strong>
              <span style="color: #7c7c7c;">Order No.:</span>
            </strong>
          </td>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" bgcolor="#ffffff" colspan="2" >
            <strong>
              <span style="color: #092d50;">#{{$order->id}}</span>
            </strong>
          </td>
        </tr> 
        <tr>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" colspan="1"  bgcolor="#ffffff" height="20">
            <strong>
              <span style="color: #7c7c7c;">Order Status:</span>
            </strong>
          </td>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" bgcolor="#ffffff" colspan="2" >
            <strong>
              <span style="color: #092d50;">{{$order->status}}</span>
            </strong>
          </td>
        </tr> 
        <tr>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" colspan="1"  bgcolor="#ffffff" height="20">
            <strong>
              <span style="color: #7c7c7c;">Activation Code:</span>
            </strong>
          </td>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" bgcolor="#ffffff" colspan="2" >
            <strong>
              <span style="color: #092d50;">{{$order->code}}</span>
            </strong>
          </td>
        </tr>   
        <tr>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" colspan="1"  bgcolor="#ffffff" height="20">
            <strong>
              <span style="color: #7c7c7c;">Order Details:</span>
            </strong>
          </td>
          <td style="text-align: left; border-bottom: 1px dotted #ccbcbc;" bgcolor="#ffffff" colspan="2" >
            <strong>
              <span style="color: #092d50;">
                This is an order for a motilix device serial-no: {{$order->device}} to be delivered on {{$order->preferred_delivery_date}} at around {{$order->preferred_delivery_time}} at {{$order->location}}, {{$order->location_details}}. Further details include {{$order->other_details}}
              </span>
            </strong>
          </td>
        </tr> 
      </tbody>
    </table>
  </main>
</body>
</html>