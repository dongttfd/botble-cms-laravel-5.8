<?php

namespace Botble\Language\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Language\Repositories\Interfaces\LanguageInterface;

class LanguageRepository extends RepositoriesAbstract implements LanguageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getActiveLanguage($select = ['*'])
    {
        $data = $this->model->orderBy('lang_order', 'asc')->select($select)->get();
        $this->resetModel();
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLanguage($select = ['*'])
    {
        $data = $this->model->where('lang_is_default', 1)->select($select)->first();
        $this->resetModel();
        return $data;
    }
}
