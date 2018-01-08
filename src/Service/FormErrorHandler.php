<?php

namespace App\Service;


use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormErrorIterator;

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

            if($error instanceof FormErrorIterator) {
                $element = $error->current()->getOrigin()->getName();
                $message = $error->current()->getMessage();
                $resultArray[$element][] = $message;
            } elseif ($error instanceof FormError) {
                $resultArray[] = $error->getMessage();
            }
        }
        return $resultArray;
    }

}