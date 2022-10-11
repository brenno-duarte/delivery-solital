<?php

namespace Solital\Components\Controller;

use Solital\Components\Model\Setting;
use Solital\Core\Resource\HandleFiles;
use Solital\Core\Resource\Message;
use Solital\Core\Wolf\Wolf;

class SettingController
{

    /**
     * @var mixed
     */
    private $imgDir;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->imgDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . '_img';
    }

    /**
     * @return void
     */
    public function informations(): void
    {
        Wolf::loadView('view.admin.admin-informations', [
            'title' => 'Informações da empresa',
            'informations' => (new Setting())->list(),
            'msg1' => Message::get('informations'),
            'msg2' => Message::get('photoSet')
        ]);

        Message::clear('informations');
        Message::clear('photoSet');
    }

    /**
     * @param string $id
     * @return void
     */
    public function informationsPost($id)
    {
        $imgMain = null;

        $post = input()->all();
        $logo = input()->file('logo');

        if ($logo->getExtension()) {
            $imgMain = 'LOGO_' . uniqid() . "." . $logo->getExtension();
            input()->file('logo')->move($this->imgDir . DIRECTORY_SEPARATOR . $imgMain);
        }

        $res = (new Setting())->update(
            $post['company'],
            $post['phone'],
            $post['email'],
            $post['address'],
            $post['district'],
            $post['state'],
            $post['number'],
            $imgMain,
            $id
        );

        if ($res == true) {
            Message::new('informations', 'Informações atualizadas com sucesso');
            response()->redirect(url('informations'));
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
            response()->redirect(url('informations'));
        }
    }

    /**
     * @return void
     */
    public function payments(): void
    {
        Wolf::loadView('view.admin.admin-payments', [
            'title' => 'Pagamentos',
            'informations' => (new Setting())->list(),
            'msg1' => Message::get('informations'),
            'msg2' => Message::get('photoSet')
        ]);

        Message::clear('informations');
        Message::clear('photoSet');
    }
}
