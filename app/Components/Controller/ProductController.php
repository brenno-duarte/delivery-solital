<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Message;
use Solital\Core\Security\Guardian;
use Solital\Core\Resource\HandleFiles;
use Solital\Components\Model\Photo;
use Solital\Components\Model\Product;
use Solital\Components\Model\Category;

class ProductController
{
    /**
     * @var string
     */
    private $imgDir;

    /**
     * Construct
     */
    public function __construct()
    {
        Guardian::checkLogin();
        $this->imgDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . '_img' . DIRECTORY_SEPARATOR . 'fotos';
    }

    /**
     * @return void
     */
    public function product(): void
    {
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
        remove_param();

        Wolf::loadView('view.admin.admin-new-product', [
            'title' => 'Novo produto',
            'categories' => (new Category())->listAll()
        ]);
    }

    /**
     * @return void
     */
    public function newProductPost(): void
    {
        $values = input()->all();
        $photos = input()->file('photo');

        /**
         * Insere foto prinicipal/única foto
         */
        $ext = input()->file('mainPhoto')->getExtension();
        $imgMain = 'IMG-' . uniqid() . "." . $ext;
        input()->file('mainPhoto')->move($this->imgDir . DIRECTORY_SEPARATOR . $imgMain);

        $res = (new Product())->insert(
            $values['category'],
            $values['name'],
            $values['price'],
            $values['description'],
            $values['stock'],
            $values['weight'],
            $values['width'],
            $values['length'],
            $values['height'],
            $imgMain
        );

        /**
         * Insere multiplas fotos
         */
        foreach ($photos as $photo) {
            if ($photo->getExtension() != "") {
                $ext = $photo->getExtension();
                $img = 'IMG_' . uniqid() . "." . $ext;
                $photo->move($this->imgDir . DIRECTORY_SEPARATOR . $img);

                (new Photo())->insert($res['lastId'], $img);
            }
        }

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
        $category = new Category();

        Wolf::loadView('view.admin.admin-edit-product', [
            'title' => 'Editar Produto',
            'product' => (new Product())->list($id),
            'category' => $category->list($id),
            'allcategory' => $category->listAll(),
            'photos' => (new Photo())->list($id),
            'msg1' => Message::get('erasePhoto')
        ]);

        Message::clear('erasePhoto');
    }

    /**
     * @param string $id
     * @return void
     */
    public function editProductPost($id): void
    {
        $oldMainPhoto = (new Product())->list((int)$id);
        $values = input()->all();
        $newMainPhoto = input()->file('mainPhoto');
        $othersPhotos = input()->file('othersPhotos');

        /**
         * Insere foto prinicipal/única foto
         */
        if ($newMainPhoto->getExtension() != "") {
            (new HandleFiles())->folder($this->imgDir)->fileExists($oldMainPhoto['mainPhoto'], true);

            $ext = $newMainPhoto->getExtension();
            $imgMainPhoto = 'IMG_' . uniqid() . "." . $ext;
            $newMainPhoto->move($this->imgDir . DIRECTORY_SEPARATOR . $imgMainPhoto);
        } else {
            $imgMainPhoto = $oldMainPhoto['mainPhoto'];
        }

        $res = (new Product())->update(
            $values['category'],
            $values['name'],
            $values['price'],
            $values['description'],
            $values['stock'],
            $imgMainPhoto,
            (float)$values['weight'],
            (float)$values['width'],
            (float)$values['length'],
            (float)$values['height'],
            $id
        );

        /**
         * Insere multiplas fotos
         */
        foreach ($othersPhotos as $photo) {
            if ($photo->getExtension() != "") {
                $ext = $photo->getExtension();
                $img = 'IMG_' . uniqid() . "." . $ext;
                $photo->move($this->imgDir . DIRECTORY_SEPARATOR . $img);

                (new Photo())->insert($id, $img);
            }
        }

        if ($res == true) {
            Message::new('editProd', 'Produto alterado com sucesso');
            response()->redirect(url('product'));
        }
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function deletePhoto($id, $idProduct): void
    {
        $imgDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . '_img' . DIRECTORY_SEPARATOR . 'fotos';

        $res = (new Photo())->listPhoto((int)$id);

        $erasePhoto = (new HandleFiles())->folder($imgDir)->fileExists($res['namePhoto'], true);

        if ($erasePhoto == true) {
            Message::new('erasePhoto', 'Foto deletada com sucesso');
            (new Photo())->delete($id);
        } else {
            Message::new('erasePhoto', 'Houve um erro ao deletar a foto');
        }

        response()->redirect(url('edit.product', ['id' => $idProduct]));
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteProduct($id): void
    {
        $res = (new Product())->delete($id);

        if ($res == true) {
            (new Photo())->delete($id);

            Message::new('delProd', 'Produto deletado com sucesso');
            response()->redirect(url('product'));
        }
    }
}
