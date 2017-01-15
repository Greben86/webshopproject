<?php

class Register_Form_Index extends Zend_Form {

  public function init() {
    // инициализируем форму
    $this->setAction('/register')->setMethod('post');

    // создаем текстовое поле для организации
    $customer = new Zend_Form_Element_Text('customer');
    $customer -> setLabel('Организация')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Укажите название организации',
        ))
        -> setOptions(array('size' => '35'))
        -> setRequired(true)
        -> addValidator('NotEmpty', false, array(
            'messages' => array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым'
            )))
        -> addFilter('HtmlEntities')
        -> addFilter('StringTrim');
    
    // создаем текстовое поле для ввода названия
    $family = new Zend_Form_Element_Text('family');
    $family -> setLabel('Фамилия')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Укажите фамилию',
        ))
        -> setOptions(array('size' => '35'))
        -> setRequired(true)
        -> addValidator('NotEmpty', false, array(
            'messages' => array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым'
            )))
        -> addFilter('HtmlEntities')
        -> addFilter('StringTrim');

    // создаем текстовое поле для ввода названия
    $name = new Zend_Form_Element_Text('name');
    $name -> setLabel('Имя')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Укажите имя',
        ))
        -> setOptions(array('size' => '35'))
        -> setRequired(true)
        -> addValidator('NotEmpty', false, array(
            'messages' => array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым'
            )))
        -> addFilter('HtmlEntities')
        -> addFilter('StringTrim');

    // создаем текстовое поле для ввода названия
    $name2 = new Zend_Form_Element_Text('name2');
    $name2 -> setLabel('Отчество')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Укажите отчество',
        ))
        -> setOptions(array('size' => '35'))
        -> setRequired(true)
        -> addValidator('NotEmpty', false, array(
            'messages' => array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым'
            )))
        -> addFilter('HtmlEntities')
        -> addFilter('StringTrim');

    // создаем текстовое поле для ввода названия
    $phone = new Zend_Form_Element_Text('phone');
    $phone -> setLabel('Телефон')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Укажите контактный телефон',
        ))
        -> setOptions(array('size' => '50'))
        -> setRequired(true)
        -> addValidator('NotEmpty', true, array(
            'messages' => array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым'
            )))
        -> addFilter('HtmlEntities')
        -> addFilter('StringTrim');

    // создаем текстовое поле для ввода адреса электронной почты
    $email = new Zend_Form_Element_Text('email');
    $email -> setLabel('Электронная почта')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Укажите адрес email',
        ))
        -> setOptions(array('size' => '100'))
        -> setRequired(true)
        -> addValidator('NotEmpty', true, array(
            'messages' => array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым'
            )))
        -> addValidator('EmailAddress', true, array(
            'messages' => array(
                Zend_Validate_EmailAddress::DOT_ATOM => "'%localPart% не соответствует формату dot-atom",
                Zend_Validate_EmailAddress::INVALID => "'%value%' неправильный адрес электронной почты. Введите его в формате имя@домен",
                Zend_Validate_EmailAddress::INVALID_FORMAT => "'%value%' неправильный адрес электронной почты. Введите его в формате имя@домен",
                Zend_Validate_EmailAddress::INVALID_HOSTNAME => "'%hostname%' недопустимое имя хоста для адреса '%value%'",
                Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "'%localPart%' недопустимое имя для адреса '%value%'",
                Zend_Validate_EmailAddress::INVALID_MX_RECORD => "'%hostname%' не имеет корректной MX-записи об адресе '%value%'",
                Zend_Validate_EmailAddress::INVALID_SEGMENT => "'%hostname%' не является маршрутизируемым сегментом сети. Адрес электронной почты '%value%' не может быть получен из публичной сети.",
                Zend_Validate_EmailAddress::LENGTH_EXCEEDED => "'%value%' превышает допустимую длину",
                Zend_Validate_EmailAddress::QUOTED_STRING => "'%localPart%' не соответствует формату quoted-string",
            )))
        -> addFilter('HtmlEntities')
        -> addFilter('StringToLower')
        -> addFilter('StringTrim');

    $note = new Zend_Form_Element_Textarea('note');
    $note->setLabel('Дополнительная информация')
        ->setAttribs(array(
            'class' => 'form-control',
            'rows'  => '3',
            'placeholder'  => 'Раскажите о себе',
        ));
    
    $image = new Zend_Form_Element_File('image');
    $image->setLabel('Отсканированный бланк заявления')
        ->setDestination(APPLICATION_PATH . '/../public/upload')
        ->setAttrib('multiple', false)
        ->addValidator('Size', false, 1024000)
        ->addValidator('Extension', false, 'jpg,png,gif,bmp,tiff,pdf,doc,docx,odt');
    
    // Капча
    $captcha = new Zend_Form_Element_Captcha('captcha', array(
        'captcha' => 'Figlet',
        'captchaOptions' => array(
            'captcha' => 'Figlet',
            'wordLen' => 6,
            'timeout' => 300,
        ),
    ));
    $captcha->setLabel('Пожалуйста подтвердите что вы человек')
        ->setAttribs(array(
            'class' => 'form-control',
            'placeholder'  => 'Введите текст с картинки',
        ));

    // создаем кнопку отправки
    $submit = new Zend_Form_Element_Submit('submit');
    $submit -> setLabel('Подать заявку')
        -> setAttribs(array('class' => 'btn btn-success'));

    // добавляем элементы к форме
    $this -> addElement($customer)
        -> addElement($family)
        -> addElement($name)
        -> addElement($name2)
        -> addElement($phone)
        -> addElement($email)
        -> addElement($note)
        -> addElement($image);

    $this->addDisplayGroup(array('customer', 'family', 'name', 'name2', 'phone', 'email', 'note', 'image'), 'zayavka');
    $this->getDisplayGroup('zayavka')
        ->setLegend('Заявление на вступление');
    $this->addElement($captcha);
    $this->addElement($submit);
  }
}

class Register_IndexController extends Zend_Controller_Action
{

    public function init()
    {
    /* Initialize action controller here */
    }

    public function indexAction()
    {
        // генерируем форму ввода
        $form = new Register_Form_Index();
        $this->view->form = $form;
        
        $session = new Zend_Session_Namespace('first.input');
        $this->view->firstinput = $session->values;

        if ($this->getRequest()->isPost()) 
        {
            if ($form->isValid($this->getRequest()->getPost())) 
            {   
                // Переименуем файл
                $originalFilename = pathinfo($form->image->getFileName());
                $newFilename = 'skan-' . uniqid() . '.' . $originalFilename['extension'];
                $form->image->addFilter('Rename', $newFilename);
                $form->image->receive();
                // Отправляем письмо
                $this->sendMail(
                        'Заявка на вступление', 
                        $this->buildBody($form->getValues()), 
                        'Скан' . '.' . $originalFilename['extension'],
                        APPLICATION_PATH . '/../public/upload/' . $newFilename);
                // Сохраняем в базу
                $this->saveStatement($form->getValues(), $newFilename);
                // Перенаправляем
                $this->_redirect('/register/success');
            }
        }
    }
    
    public function successAction()
    {
        //
    }
    
    private function sendMail($subject, $body, $filename, $filepath)
    {
        $config = array(
            'ssl' => 'ssl',
            'port' => 465,
            'auth' => 'login', 
            'username' => 'grebenvictor',
            'password' => '21pnds73rdit'
        );       

        $mail = new Zend_Mail();
        $mail->setBodyHtml($body);
        $mail->setFrom('grebenvictor@yandex.ru', 'Система регистрации участников');
        $mail->addTo('grebenvictor@yandex.ru', 'Администратор кооператива');
        $mail->setSubject($subject);

        $at = new Zend_Mime_Part(file_get_contents($filepath));
        $at->disposition = Zend_Mime::DISPOSITION_INLINE;
        $at->encoding = Zend_Mime::ENCODING_BASE64;
        $at->filename = $filename;

        $mail->addAttachment($at);

        $transport = new Zend_Mail_Transport_Smtp('smtp.yandex.ru', $config);
        
        $mail->send($transport);
    }
    
    private function buildBody($values)
    {
        $domDoc = new DOMDocument();
        $title = $domDoc->createElement( 'h2', $values['customer'] );
        $person = $domDoc->createElement( 'h3', trim(trim($values['family']. ' ' . $values['name']) . ' ' . $values['name2']) );
        $phone = $domDoc->createElement( 'p', 'Тел.: ' );
        $phone->appendChild( new DOMElement( 'b', $values['phone'] ) );
        $email = $domDoc->createElement( 'p', 'Email: ' );
        $email->appendChild( new DOMElement( 'b', $values['email'] ) );
        $note = $domDoc->createElement( 'p', $values['note'] );

        $domDoc->appendChild($title);
        $domDoc->appendChild($person);
        $domDoc->appendChild($phone);
        $domDoc->appendChild($email);
        $domDoc->appendChild( new DOMElement( 'br' ) );
        $domDoc->appendChild($note);

        return $domDoc->saveHTML();
    }
    
    private function saveStatement($values, $file)
    {
        // Подключаемся к БД
        $db = Zend_Db::factory('Pdo_Mysql', array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => '123',
            'dbname'   => 'webshop'
        ));
        // Формируем массив данных
        $data = array(
            'email'     => $values['email'],
            'fullname'  => $values['customer'],
            'family'    => $values['family'],
            'name'      => $values['name'],
            'name2'     => $values['name2'],
            'phone'     => $values['phone'],
            'note'      => $values['note'],
            'filename'  => $file
        );
        // Сохраняем данные
        $db->insert('statements', $data);
    }

}

