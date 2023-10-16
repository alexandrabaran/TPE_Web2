<?php

   class errorView {
    public function showError($error){
        authHelper::init();
        require 'templates/error.phtml';
    }
  }
