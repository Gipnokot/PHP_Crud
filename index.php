<?php include 'foo.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-success mt-2" data-toggle="modal" data-target="#create"><i class="fas fa-plus"></i></button>
                <table class="table table-striped table-hover mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $res) { ?>
                        <tr>
                            <td><?php echo $res->id; ?></td>
                            <td><?php echo $res->name; ?></td>
                            <td><?php echo $res->email; ?></td>
                            <td>
                                <a href="?id=<?php echo $res->id; ?>" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $res->id; ?>"><i class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $res->id; ?>"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        
                        <!-- Modal edit-->
                        <div class="modal fade" id="edit<?php echo $res->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Изменить запись</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="?id=<?php echo $res->id; ?>" method="POST">
                                  <div class="form-group">
                                    <small>Имя</small>
                                    <input type="text" class="form-control" name="name" value="<?php echo $res->name; ?>">
                                  </div>
                                  <div class="form-group">
                                    <small>Email</small>
                                    <input type="text" class="form-control" name="email" value="<?php echo $res->email; ?>">
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary" name="edit">Сохранить</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal delete-->
                        <div class="modal fade" id="delete<?php echo $res->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Удалить запись № <?php echo $res->id; ?></h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer">
                                <form action="?id=<?php echo $res->id; ?>" method="POST">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                  <button type="submit" class="btn btn-danger" name="delete">Удалить</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Modal create-->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить запись</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="form-group">
                <small>Имя</small>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <small>Email</small>
                <input type="text" class="form-control" name="email">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            <button type="submit" class="btn btn-primary" name="add">Сохранить</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
