<?php

// このファイルを実行するとMonacard1.0のメタデータをMonacoinブロックチェーンからダウンロードします。
// /data/に保存された7zファイル解凍し、dataフォルダ直下に配置してください。

require_once __DIR__ . '/../classes/counterparty.php';

$tx_hash_list = [];
$tx_hash_list[] = "0f6d783b4ae57f76750768774a3c89d5a1700954289b1cb581c75ca8f78f657b";
$tx_hash_list[] = "52db2b87b96b9441d45f3107e4298606b27dcd72f73dd294aff3c30bcf66ad9a";
$tx_hash_list[] = "0f4c0cb4cb71aa9c66b4f02cdf66e45e67097e98fd4290bed0f964909f12e086";
$tx_hash_list[] = "aca68a7ea2b1f1437b74da7db4b8260f2b45baa137e4b0e6c9db7f1fe1b3cd9e";
$tx_hash_list[] = "abc4af701bacc4137832730a1c670771bf4b81a824c58d155cfb9e998e68db9d";
$tx_hash_list[] = "4a461c1ad236c67848b56b30bc011064d0dfb9c801b6fa4e4579cdf8cb989137";
$tx_hash_list[] = "12e35c6ada471b5cc06dafb37d37cee2ccfa138a9c2cf5a1af395b413d60574a";
$tx_hash_list[] = "8efa4786b749475897e73ba754a4b7960d7c68f6169a8dd752806a7137929efb";
$tx_hash_list[] = "2eb16e4e7827d6b44e065520d51e48d4c05a92abbcb315e1d87627d169235f17";
$tx_hash_list[] = "12efac9009803a836cb1fc59f4801890c5e4685cd636717c813d6818108ef0cf";
$tx_hash_list[] = "8228e1b141876f6280cc2f1610da50b25b25d1c21312792b693bd9bdf86e119c";
$tx_hash_list[] = "525577e0aef205338bb06d331570aad604c9373950c7aa7f5b482d347bee054a";
$tx_hash_list[] = "263ab932f491c29c59880fc12d1e17654d7455fd5608d7db05efb3eec532a09f";
$tx_hash_list[] = "a07e3bda69e526a5089cc51d91675fa8d4407dbb4e5df47b129e5216c5cafaf5";
$tx_hash_list[] = "166eadcd375a302b7d3394d10dad601c26054992f29d3cfefb781bd9740e3bf3";
$tx_hash_list[] = "0596a4730437c0f96a074a754fe2b1708aa02dff041935632fc3e6f323e2f70d";
$tx_hash_list[] = "efedbd97a6fc7b7e49773489f6c346bec7f06f907c18a7c8d72886c0c64f4ab1";
$tx_hash_list[] = "2bf71b4ed7945e93e833d28adf0f81ae8b99a67925bbcaa5d633d79e396d81c7";
$tx_hash_list[] = "497af7415b77ade12baf562569d38b076b977d89249fb6f888e10e307c7dd20b";
$tx_hash_list[] = "d62ca13a746e9c045a02da23f98753c7bf7683b9c7efce4b238afaf7fb5f88b5";
$tx_hash_list[] = "e381c7fb81578e47a9636af3995b599a6b4d57ceb788d8a073925f7e434b3ce3";
$tx_hash_list[] = "80fd05ff16d191a2158d8ced4ba2183c2fdfe3404058d32fbb8f5291ea9479d0";
$tx_hash_list[] = "0e000856b22e3986b61bb27ead7d5c2794bed657f4de461b4bd0092a8aea38ed";
$tx_hash_list[] = "46a5f679c6142f40de8fe2921f4113d5e03536a1535dea5c494c321ac6c9d1ea";
$tx_hash_list[] = "14efe68aea552244983e19e61c06009aedcfdefc0cc838ef18e6332df14b43dc";
$tx_hash_list[] = "59f8aeb203b4da5b22cab5f574dd39b514883f5e84eb9a1486a35dde74b6bf1c";
$tx_hash_list[] = "35f76c27e44e3d4d9e944524f4080af206f207223d936e716537e05ae4d9b036";
$tx_hash_list[] = "31f5dd5389db8cce6a87c535b3d9c20f00c2beff42c2635bb3fbe1fc4e1f744d";
$tx_hash_list[] = "6073de1f1569f9d9cd4646e9c70f34bf60f2058833da0a75841de22f4ff7c2d1";
$tx_hash_list[] = "2a7b1b37d1b1e2e8dd82ccd4bd286dfa2c49328cbc3b9a03f74375353efbe356";
$tx_hash_list[] = "46cf1fcd17e0792023f1d801f42de42354f288345e3f0de62c5da02a172e64e8";
$tx_hash_list[] = "fab904aa6892a942224239d6e3840efc23d38020e64720a3d168623ac0840d67";
$tx_hash_list[] = "4f6ed7659d533435221f1a244ea46fc3c2a0881409c8f1e33f54232c20685268";
$tx_hash_list[] = "c27c01f69210293c8701f81aca76af89286085552ac614c130bd19e3b14c34f1";
$tx_hash_list[] = "15026b6ce93391c84c10216244e2a74f0dcee703c8bb3afa704cba8526dfe95a";
$tx_hash_list[] = "bcbfadac84b3443a2826e2ce79579629c3bc8bed35d4e0baef56a4ba8819202b";
$tx_hash_list[] = "f275a54eaf21b4c3807989b1414066ac5dcdd09f238e51cc92fb601f41fe26a0";
$tx_hash_list[] = "9cb30c49d2c289b5d8bacbd81b1dce3f2977813f84d68944b376d22b4d5af189";
$tx_hash_list[] = "9f233599487dc09dd89e53ba9ba18dcca3d036d8311ee7cfb0f98e27b0b4baea";
$tx_hash_list[] = "278e63f524ebf46c427d4186011c5c6cf1368df1225e8a16646526d9f11b2219";
$tx_hash_list[] = "6a55e22258a78eda1e8b811bba6b4d33a6bf91c8f3d7e73580b1313cc8a2a0fd";
$tx_hash_list[] = "1bf1af1044aeb37a55ec2e123398fa52d8b43cf2542a7d1fc51505f9310caa80";
$tx_hash_list[] = "0465d7fc0561b22afc49b2f5c2545cc80b4c25fe000ad55735d2b8216649766c";
$tx_hash_list[] = "f35e5c9a11eb84f0e7dde6b9d1ce28b6fe6a1c9566a305b5d99814d932a9004a";

$metadata_file_base64 = "";
foreach($tx_hash_list as $hash) {
    $metadata_file_base64 .= Counterparty::get_broadcast($hash);
}

$nanaz = base64_decode($metadata_file_base64);
$file_name = "./../data/monacard1.0metadata.7z";
file_put_contents($file_name, $nanaz);

?>