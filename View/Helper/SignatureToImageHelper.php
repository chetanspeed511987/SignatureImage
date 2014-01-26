<?php
App::uses('AppHelper', 'View/Helper');

class SignatureToImageHelper extends AppHelper {
   
    public $helpers = array('Html', 'Form');
   
   public function accept() {

        $html = array();
       
        $html[] = $this->Html->css('SignatureImage.jquery.signaturepad'); 

        $html[] = $this->Html->script('SignatureImage.jquery.1.7.1');   

        $html[] = '<div class="sigPad">
					  <div class="sig sigWrapper">
					    <div class="typed"></div>
					    <canvas class="pad" width="198" height="55"></canvas>';
       
        $html[] = $this->Form->input('signature',array('type' => 'hidden', 'class' => 'output'));

        $html[] = '</div></div>';

        $html[] =  $this->Html->script('SignatureImage.jquery.signaturepad.min');

        $html[] =  ' <script>
					    $(document).ready(function () {
					      $(".sigPad").signaturePad({drawOnly : true});
					    });
					  </script>';

        $html[] =  $this->Html->script('SignatureImage.json2.min');

        return "\n" . implode("\n", $html);
    }
   
  public function regenerate($signature = null) {

        $html = array();
       
        $html[] = $this->Html->css('SignatureImage.jquery.signaturepad');   

        $html[] = $this->Html->script('SignatureImage.jquery.1.7.1');   

        $html[] = '<div class="sigPad signed">
					  <div class="sigWrapper">
					    <canvas class="pad" width="198" height="55"></canvas>
					  </div>
					</div>';
       
        $html[] =  $this->Html->script('SignatureImage.jquery.signaturepad.min');
        
        $html[] =  '<script>
					    $(document).ready(function () {
						  // Write out the complete signature from the database to Javascript
					      var sig = '. $signature .';
					      $(".sigPad").signaturePad({displayOnly : true}).regenerate(sig);
					    });
					  </script>';

        $html[] =  $this->Html->script('SignatureImage.json2.min');

        return "\n" . implode("\n", $html);
    }
}

?>