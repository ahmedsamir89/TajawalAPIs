<?php

namespace App\Service;


use Symfony\Component\Form\Form;

class FormErrorHandler
{

    /**
     * @param Form $form
     * @return array
     */
    public function getFormErrorsAsArray(Form $form)
    {
        $resultArray = [];
        $errors = $form->getErrors(true, false);
        foreach ($errors as $error) {
            $element = $error->current()->getOrigin()->getName();
            $message = $error->current()->getMessage();
            $resultArray[$element][] = $message;
        }
        return $resultArray;
    }

}