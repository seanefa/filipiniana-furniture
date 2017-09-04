<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Elements</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="elements.php">Elements</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Elements</h1>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-6">
              <h2 class="text-uppercase">Typography</h2>
              <h1>H1 Heading. Lorem ipsum dolor</h1>
              <h2>H2 Heading. Lorem ipsum dolor</h2>
              <h3>H3 Heading. Lorem ipsum dolor</h3>
              <h4>H4 Heading. Lorem ipsum dolor</h4>
              <h5>H5 Heading. Lorem ipsum dolor</h5>
              <h6>H6 Heading. Lorem ipsum dolor</h6>
              <div class="divider"></div>
              <h2 class="text-uppercase">Accordion</h2>
              <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#accordion-1">Accordion Title #1 <i class="fa fa-caret-down"></i></a></h4>
                  </div>
                  <div id="accordion-1" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu. </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#accordion-2">Accordion Title #2 <i class="fa fa-caret-down"></i></a></h4>
                  </div>
                  <div id="accordion-2" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu. </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#accordion-3">Accordion Title #3 <i class="fa fa-caret-down"></i></a></h4>
                  </div>
                  <div id="accordion-3" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu. </div>
                  </div>
                </div>
              </div>
              <h2 class="text-uppercase">List</h2>
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <h5 class="text-uppercase">Unordered</h5>
                  <ul class="simple-ul">
                    <li>Lorem ipsum dolor amet</li>
                    <li>Consectetur adipiscing elit </li>
                    <li>Donec eros tellus </li>
                    <li>Nullam ac nisi non eros gravida venenatis
                      <ul>
                        <li>Libero massa dapibus dui, eu</li>
                        <li>Celerisque nec, rhoncus eget</li>
                        <li>Praesent vitae dui</li>
                        <li>Ut euismod, turpis sollicitudin</li>
                      </ul>
                    </li>
                    <li>Dolor sit amet, consectetuer</li>
                    <li>Vehicula venenatis, tempor vitae</li>
                    <li>Fermentum posuere lectus</li>
                    <li>Maecenas eu enim in lorem</li>
                  </ul>
                  <div class="divider visible-sm visible-xs"></div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <h5 class="text-uppercase">Ordered</h5>
                  <ul class="decimal-list">
                    <li>Lorem ipsum dolor amet</li>
                    <li>Consectetur adipiscing elit</li>
                    <li>Donec eros tellus </li>
                    <li>Nullam ac nisi non eros gravida</li>
                    <li>Libero massa dapibus dui, eu</li>
                    <li>Celerisque nec, rhoncus eget</li>
                    <li>Praesent vitae dui</li>
                    <li>Ut euismod, turpis sollicitudin</li>
                    <li>Ac tristique libero volutpat at</li>
                    <li>Faucibus porta lacingilla vel</li>
                    <li>Eget porttitor lorem</li>
                    <li>Integer vel nibh sit amet</li>
                  </ul>
                </div>
              </div>
              <div class="divider"></div>
              <h2 class="text-uppercase">Buttons</h2>
              <div class="row">
                <div class="col-sm-4">
                  <button class="btn btn-primary btn-lg" href="#">Large button</button>
                  <br>
                  <br>
                  <button class="btn btn-primary" href="#">Default button</button>
                  <br>
                  <br>
                  <button class="btn btn-primary btn-sm" href="#">Small button</button>
                </div>
                <div class="col-sm-4">
                  <button class="btn btn-default btn-lg" href="#">Large button</button>
                  <br>
                  <br>
                  <button class="btn btn-default" href="#">Default button</button>
                  <br>
                  <br>
                  <button class="btn btn-default btn-sm" href="#">Small button</button>
                </div>
                <div class="col-sm-4">
                  <button class="btn btn-warning" href="#">Warning button</button>
                  <br>
                  <br>
                  <button class="btn btn-danger" href="#">Danger button</button>
                  <br>
                  <br>
                  <button class="btn btn-success" href="#">Success button</button>
                  <br>
                  <br>
                  <button class="btn btn-info" href="#">Info button</button>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <h2 class="text-uppercase">Alert Box</h2>
              <div class="alert alert-info"><i class="fa fa-info-circle"></i> Information - Lorem ipsum dolor sit amet, con sectetuer adipiscing elit.</div>
              <div class="alert alert-success"><i class="fa fa-check-circle"></i> Success - Lorem ipsum dolor sit amet, con sectetuer adipiscing elit.</div>
              <div class="alert alert-warning"><i class="fa fa-warning"></i> Warning - Lorem ipsum dolor sit amet, con sectetuer adipiscing elit.</div>
              <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Danger - Lorem ipsum dolor sit amet, con sectetuer adipiscing elit.</div>
              <h2 class="text-uppercase">Tabs</h2>
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">Tab #1</a></li>
                <li><a data-toggle="tab" href="#tab-2">Tab #2</a></li>
                <li><a data-toggle="tab" href="#tab-3">Tab #3</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab-1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus.</div>
                <div class="tab-pane" id="tab-2">Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</div>
                <div class="tab-pane" id="tab-3">Consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Lorem ipsum dolor sit amet,</div>
              </div>
              <div class="divider"></div>
              <h2 class="text-uppercase">Blockquote</h2>
              <blockquote>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu. </p>
                <footer>Ipsum dolor sit</footer>
              </blockquote>
              <h2 class="text-uppercase">Blockquote Reverse</h2>
              <blockquote class="blockquote-reverse">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu. </p>
                <footer>Ipsum dolor sit</footer>
              </blockquote>
              <h2 class="text-uppercase">Dropcaps</h2>
              <p> <span class="dropcap custom-color">D</span> olor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci.</p>
            </div>
          </div>
          <div class="divider"></div>
          <h2 class="text-uppercase">Tables</h2>
          <div class="row">
            <div class="col-md-6">
              <h4 class="text-uppercase">Basic Table</h4>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Aaron</td>
                    <td>Seth</td>
                    <td>@aaron</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Daichi</td>
                    <td>Barbal</td>
                    <td>@daichi</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Tabor</td>
                    <td>Guju</td>
                    <td>@tabor</td>
                  </tr>
                </tbody>
              </table>
              <h4 class="text-uppercase">Striped Table</h4>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Aaron</td>
                      <td>Seth</td>
                      <td>@aaron</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Daichi</td>
                      <td>Barbal</td>
                      <td>@daichi</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Tabor</td>
                      <td>Guju</td>
                      <td>@tabor</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <h4 class="text-uppercase">Bordered Table</h4>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Aaron</td>
                      <td>Seth</td>
                      <td>@aaron</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Daichi</td>
                      <td>Barbal</td>
                      <td>@daichi</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Tabor</td>
                      <td>Guju</td>
                      <td>@tabor</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <h4 class="text-uppercase">Hover rows Table</h4>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Aaron</td>
                      <td>Seth</td>
                      <td>@aaron</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Daichi</td>
                      <td>Barbal</td>
                      <td>@daichi</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Tabor</td>
                      <td>Guju</td>
                      <td>@tabor</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="divider"></div>
          <h2 class="text-uppercase">Grid</h2>
          <div class="row">
            <div class="col-lg-12">
              <h5>1 COLUMN</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-6">
              <h5>1/2 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
            <div class="col-sm-6">
              <h5>1/2 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-4">
              <h5>1/3 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, con sectetuer adipiscing elit. Donec eros tellus, scelerisqu nec, rhonc us eget, sollicitudin eu, vehicula venenatis, tem por vitae, est. Praesent vitae dui. Morbi id tellus. Nullam massa. Sad dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
            <div class="col-sm-4">
              <h5>1/3 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, con sectetuer adipiscing elit. Donec eros tellus, scelerisqu nec, rhonc us eget, sollicitudin eu, vehicula venenatis, tem por vitae, est. Praesent vitae dui. Morbi id tellus. Nullam massa. Sad dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
            <div class="col-sm-4">
              <h5>1/3 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, con sectetuer adipiscing elit. Donec eros tellus, scelerisqu nec, rhonc us eget, sollicitudin eu, vehicula venenatis, tem por vitae, est. Praesent vitae dui. Morbi id tellus. Nullam massa. Sad dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-8">
              <h5>2/3 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
            <div class="col-sm-4">
              <h5>1/3 COLUMNS</h5>
              <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. </p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3">
              <h5>1/4 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. </p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
              <h5>1/4 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. </p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
              <h5>1/4 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. </p>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
              <h5>1/4 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. </p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-9">
              <h5>3/4 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
            <div class="col-sm-3">
              <h5>1/4 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. </p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-6 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc.</p>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc.</p>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc.</p>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc.</p>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc.</p>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc.</p>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-8 col-md-10 col-lg-10">
              <h5>5/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
            </div>
            <div class="col-sm-4 col-md-2 col-lg-2">
              <h5>1/6 COLUMNS</h5>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. </p>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>