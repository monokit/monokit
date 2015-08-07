<style>
    @import url(http://fonts.googleapis.com/css?family=Droid+Sans:400,700);
</style>

<div style="font-family: 'Droid Sans', sans-serif;background-color: #EFEFEF;border:2px solid rgba(255,0,0,.15);border-radius: 5px;padding: 10px;margin:50px;box-shadow: 0 0 10px 0 #000000;">
    <img src="<?php echo $this->icon; ?>" style="float:left;padding-right:20px;"/>
    <H1 style="margin:10px 0 0 0;padding: 0;font-size: 30px;font-weight: normal;"><?php echo $this->class; ?></H1>
    <P><?php echo utf8_decode( $this->getMessage() ); ?></P>
    <button style="padding:10px;font-size: 16px;text-align: left;"><?php var_dump($this->vars); ?></button>
</div>