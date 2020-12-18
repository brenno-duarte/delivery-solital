<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Message;
use Solital\Core\Security\Guardian;
use Solital\Components\Model\Product;
use Solital\Components\Model\Category;
use Solital\Components\Model\Photo;

class ProductController
{
    /**
     * @return void
     */
    public function product(): void
    {
        Guardian::checkLogin();
        $pag = (new Product())->pagination();

        if ($pag['rows'] == null) {
            remove_param();
        }

        Wolf::loadView('view.admin.admin-product', [
            'title' => 'Produtos',
            'rows' => $pag['rows'],
            'arrows' => $pag['arrows'],
            'msg1' => Message::get('cadProd'),
            'msg2' => Message::get('editProd'),
            'msg3' => Message::get('delProd')
        ]);

        Message::clear('cadProd');
        Message::clear('editProd');
        Message::clear('delProd');
    }

    /**
     * @return void
     */
    public function newProduct(): void
    {
        Guardian::checkLogin();
        remove_param();

        Wolf::loadView('view.admin.admin-new-product', [
            'title' => 'Novo produto',
            'categories' => (new Category())->listAll()
        ]);
    }

    /**
     * @param string $id
     * @return void
     */
    public function newProductPost(): void
    {
        Guardian::checkLogin();
        $category = input()->post('category')->getValue();
        $name = input()->post('name')->getValue();
        $price = input()->post('price')->getValue();
        $description = input()->post('description')->getValue();
        $stock = input()->post('stock')->getValue();
        $photo = input()->file('photo');

        /**
         * Insere foto prinicipal/única foto
         */
        $ext = input()->file('mainPhoto')->getExtension();
        $imgMain = 'IMG-'.uniqid().".".$ext;
        input()->file('mainPhoto')->move(UP_DIR.'/fotos/'.$imgMain);
        
        $res = (new Product())->insert($category, $name, $price, $description, $stock, $imgMain);

        /**
         * Insere multiplas fotos
         */
        foreach ($photo as $photo) {
            $ext = $photo->getExtension();
            $img = 'IMG-'.uniqid().".".$ext;
            $photo->move(UP_DIR.'/fotos/'.$img);

            (new Photo())->insert($res['lastId'], $img);
        }

        (new Photo())->insert($res['lastId'], $imgMain);

        if ($res == true) {
            Message::new('cadProd', 'Produto cadastrado com sucesso');
            response()->redirect(url('product'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function editProduct($id): void
    {
        Guardian::checkLogin();
        $category = new Category();

        Wolf::loadView('view.admin.admin-edit-product', [
            'title' => 'Editar Produto',
            'product' => (new Product())->list($id),
            'category' => $category->list($id),
            'allcategory' => $category->listAll(),
            'first_photo' => (new Photo())->list($id)[0],
            'photos' => (new Photo())->list($id)
        ]);
    }

    /**
     * @param string $id
     * @return void
     */
    public function editProductPost($id): void
    {
        Guardian::checkLogin();
        $category = input()->post('category')->getValue();
        $name = input()->post('name')->getValue();
        $price = input()->post('price')->getValue();
        $description = input()->post('description')->getValue();
        $stock = input()->post('stock')->getValue();
        $photo = input()->file('photo');
        
        $res = (new Product())->update($category, $name, $price, $description, $stock, $id);

        foreach ($photo as $photo) {
            $ext = $photo->getExtension();
            $img = 'IMG-'.uniqid().".".$ext;
            $photo->move(UP_DIR.'/fotos/'.$img);

            (new Photo())->insert($id, $img);
        }
        
        if ($res == true) {
            Message::new('editProd', 'Produto alterado com sucesso');
            response()->redirect(url('product'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteProduct($id): void
    {
        Guardian::checkLogin();
        $res = (new Product())->delete($id);
        
        if ($res == true) {
            (new Photo())->delete($id);
            Message::new('delProd', 'Produto deletado com sucesso');
            response()->redirect(url('product'));
        }
    }
}