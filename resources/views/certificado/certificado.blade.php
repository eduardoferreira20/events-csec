  <!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Certificado</title>

<style type="text/css">

  .row{
    background-repeat: no-repeat;
    height: 100%;
  }

  .conteiner{
    height: 800px;
    
  }

.nome{
  float: left;
  width: 50%;
}

.pdf-container{
  margin-top: 5%;
}

  </style>

  </head>
  <body>

    <div class="conteiner">
      <div class="row">
        <div class="col-md-12">
          <div class="pdf-container" style="width: 80%; margin-left: 15%;" >
            <table class="table">
              <tbody>
               @foreach($user as $user)
               <tr>
                <p class="nome">{{$user->name}}</p>
                <p class="nome"> {{$user->email}}</p>
                <p class="nome">{{$user->documento}}</p>
                <p></p>
               <a href="{{(url('/pdf/download/'.$user->id) )}}" class="btn" >Download PDF</a>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 

  </body>
  </html>