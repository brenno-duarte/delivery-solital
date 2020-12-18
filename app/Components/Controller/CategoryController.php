<?php

namespace Solital\Components\Controller;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Message;
use Solital\Core\Security\Guardian;
use Solital\Components\Model\Category;

class CategoryController
{   
    /**
     * @return void
     */
    public function category(): void
    {
        Guardian::checkLogin();
        $pag = (new Category())->pagination();
        
        $msg1 = Message::get('cadCat');
        $msg2 = Message::get('editCat');
        $msg3 = Message::get('delCat');

        Wolf::loadView('view.admin.admin-category', [
            'title' => 'Categoria',
            'rows' => $pag['rows'],
            'arrows' => $pag['arrows'],
            'msg1' => $msg1,
            'msg2' => $msg2,
            'msg3' => $msg3
        ]);

        Message::clear('cadCat');
        Message::clear('editCat');
        Message::clear('delCat');
    }

    /**
     * @return void
     */
    public function newCategory(): void
    {
        Guardian::checkLogin();
        remove_param();
        
        Wolf::loadView('view.admin.admin-new-category', [
            'title' => 'Nova Categoria'
        ]);
    }

    /**
     * @return void
     */
    public function newCategoryPost()
    {
        Guardian::checkLogin();
        $name = input()->post('name')->getValue();
        
        $res = (new Category())->insert($name);

        if ($res == true) {
            Message::new('cadCat', 'Categoria cadastrada com sucesso');
            response()->redirect(url('category'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function editCategory($id): void
    {
        Guardian::checkLogin();
        $category = (new Category())->list($id);

        Wolf::loadView('view.admin.admin-edit-category', [
            'title' => 'Editar Categoria',
            'category' => $category
        ]);
    }

    /**
     * @param string $id
     * @return void
     */
    public function editCategoryPost($id): void
    {
        Guardian::checkLogin();
        $name = input()->post('name')->getValue();
        $res = (new Category())->update($name, $id);
        
        if ($res == true) {
            Message::new('editCat', 'Categoria alterada com sucesso');
            response()->redirect(url('category'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteCategory($id): void
    {
        Guardian::checkLogin();
        $res = (new Category())->delete($id);
        
        if ($res == true) {
            Message::new('delCat', 'Categoria deletada com sucesso');
            response()->redirect(url('category'));
        }
    }
}