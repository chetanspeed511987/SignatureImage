# SignatureImage


## Step 1 :

Write below code in `app/Config/bootstrap.php`

```php
CakePlugin::load('SignatureImage');
```


## Step 2 :

Write below code in your contoller in which you want to create signatute to image

```php
public $components = array('SignatureImage.SignatureToImage');

public $helpers = array('SignatureImage.SignatureToImage');
```


## Step 3 :

Put below code in your `ctp` file, It make a singaturebox where you can draw you signature.

```php
<?php echo $this->SignatureToImage->accept(); ?>
```


## Step 4 :

Put below code in your perticular action of controller. It create a new signature image in your folder from json. 

```php
$json = $this->request->data['Signature']['signature']; // From Signature Pad
$img = $this->SignatureToImage->signJsonToImage($json);

$sign_image = WWW_ROOT.'img/signature'.rand().'.png';
$this->SignatureToImage->saveImage($img, $sign_image);
```

## Example :

**View :** Below code is the `add.ctp` where we make a signaturebox.

```php
<div class="signatures form">
<?php echo $this->Form->create('Signature',array('class' => 'sigPad2')); ?>
	<fieldset>
		<legend><?php echo __('Form Signature'); ?></legend>
	
  	<?php echo $this->SignatureToImage->accept(); ?>
	
  </fieldset>
<?php
echo $this->Form->submit('Save');
echo $this->Form->end();
?>
</div>
```

**Controller :** Below code is action where we convert json to image and create a new signature image in define folder.

```php
public function add() {
		if ($this->request->is('post')) {
			$this->Signature->create();
			//pr($this->request->data);exit;
			if ($this->Signature->save($this->request->data)) {

				$json = $this->request->data['Signature']['signature']; // From Signature Pad
				$img = $this->SignatureToImage->signJsonToImage($json);

				$sign_image = WWW_ROOT.'img/signature'.rand().'.png';
				$this->SignatureToImage->saveImage($img, $sign_image);

				$this->Session->setFlash(__('The signature has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The signature could not be saved. Please, try again.'));
			}
		}
	}
```

