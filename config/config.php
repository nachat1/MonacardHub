<?php

class Config {

    // �Ǘ��҂̖��O
    public static $ADMINISTRATOR_NAME = "Anonymous";

    // �O��API�ƒʐM���鎞��SSL�ݒ�
    // ��{�I�ɂ�true�ɂ��āA�e�X�g���ȂǂŃG���[���o��Ƃ������ꎞ�I��false�ɂ��Ă��������B
    public static $SETTING_CURLOPT_SSL_VERIFYPEER = false;

    // counterparty api��URL�BAPI�m�[�h�������Ă���Ƃ��͕ύX���Ă��������B
    public static $COUNTERPARTY_API_URL = "https://monapa.electrum-mona.org/_api";
    //public static $COUNTERPARTY_API_URL = "https://mpchain.info/api/cb";
    //public static $COUNTERPARTY_API_URL = "https://wallet.monaparty.me/_api";

}

class Database_Config {

    public static $PATH = "localhost";
    public static $NAME = "monacard";
    public static $USER = "root";
    public static $PASSWORD = "basic321";

}