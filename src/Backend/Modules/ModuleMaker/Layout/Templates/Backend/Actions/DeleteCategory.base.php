<?php

namespace Backend\Modules\{$camel_case_name}\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Modules\{$camel_case_name}\Engine\Model as Backend{$camel_case_name}Model;

/**
 * This action will delete a category
 *
 * @author {$author_name} <{$author_email}>
 */
class DeleteCategory extends ActionDelete
{
    /**
     * Execute the action
     */
    public function execute()
    {
        $id = $this->getParameter('id', 'int');

        // does the item exist
        if ($id == null || !Backend{$camel_case_name}Model::existsCategory($id)) {
            return $this->redirect(
                Model::createURLForAction('categories') . '&error=non-existing'
            );
        }

        // fetch the category
        $record = (array) Backend{$camel_case_name}Model::getCategory($id);

        // delete item
        Backend{$camel_case_name}Model::deleteCategory($id);

        // category was deleted, so redirect
        return $this->redirect(
            Model::createURLForAction('categories') . '&report=deleted-category&var=' .
            urlencode($record['title'])
        );
    }
}
