<?php

namespace Blog\RunBlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BlogRunBlogBundle extends Bundle
{
  public function getParent()
  {
    return "FOSUserBundle";
  }
}
