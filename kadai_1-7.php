<?PHP
  // �ǂݍ��ރt�@�C�����̎w��
  $file_name = "kadai_1-6.txt";
  // �t�@�C����S�Ĕz��ɓ����
  $ret_array = file( $file_name );

  // �擾�����t�@�C���f�[�^(�z��)��S�ĕ\������
  for( $i = 0; $i < count($ret_array); ++$i ) {
    // �z������Ԃɕ\������
    echo( $ret_array[$i] . "<br />\n" );
  }
?>