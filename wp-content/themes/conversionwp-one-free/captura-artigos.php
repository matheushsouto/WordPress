<?php $captura = get_option( 'caixa_captura' ); ?>
<?php if ($captura['exibir_artigos']){ ?>
<div class="captura captura-artigos">
        <div class="row">
        <div class="ebook col-md-5">
            <img src="<?php $image = wp_get_attachment_image_src($captura['ebook'], 'full'); echo $image[0]; ?>" />
        </div>
        <div class="col-md-7">
            <h2><?php echo $captura['titulo']; ?></h2>
            <h3><?php echo $captura['subtitulo']; ?></h3>
            <?php echo criar_formulario_captura($captura['form'], $captura['botao'], $captura['placeholder']);?>
            
            <p class="privacy"><img src="<?php echo get_template_directory_uri(); ?>/images/privacy.png" alt="privacidade"><?php echo $captura['privacidade'] ;?></p>
        </div>
        </div>
</div>
<?php } ?>
