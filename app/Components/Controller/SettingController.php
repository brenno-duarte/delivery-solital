<?php

namespace Solital\Components\Controller;

use Solital\Components\Model\Setting;
use Solital\Core\Resource\HandleFiles;
use Solital\Core\Resource\Message;
use Solital\Core\Wolf\Wolf;

class SettingController
{
    /**
     * @return void
     */
    public function setting(): void
    {
        Wolf::loadView('view.admin.admin-setting', [
            'title' => 'Configurações',
            'setting' => (new Setting())->list(),
            'msg1' => Message::get('setting'),
            'msg2' => Message::get('photoSet')
        ]);

        Message::clear('setting');
        Message::clear('photoSet');
    }

    /**
     * @param string $id
     * @return void
     */
    public function settingPost($id)
    {
        $post = input()->all();
        $ext = input()->file('logo')->getExtension();
        $imgMain = 'IMG-'.uniqid().".".$ext;
        input()->file('logo')->move(UP_DIR.'/'.$imgMain);

        $res = (new Setting())->update($post['company'], $post['phone'], $post['email'], 
        $post['address'], $post['district'], $post['state'], $post['number'], $imgMain, $id);

        if ($res == true) {
            Message::new('setting', 'Configurações atualizadas com sucesso');
            response()->redirect(url('setting'));
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteLogo($id)
    {
        $logo = (new Setting())->listLogo($id);
        $res = (new HandleFiles())->folder(UP_DIR)->fileExists($logo['logo'], true);
        (new Setting())->updatePhoto(null, $id);

        if ($res == true) {
            Message::new('photoSet', 'Foto excluida com sucesso');
            response()->redirect(url('setting'));
        }
    }
}