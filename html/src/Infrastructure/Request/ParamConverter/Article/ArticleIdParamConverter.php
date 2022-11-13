<?php declare(strict_types=1);

namespace Blog\Infrastructure\Request\ParamConverter\Article;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleIdParamConverter implements ParamConverterInterface
{
    private const PARAM_TYPE = 'query';

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $name = $configuration->getName();
        $class = $configuration->getClass();
        $object = new $class((int)$request->attributes->get($name));
        $request->attributes->set($name, $object);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getName() === self::PARAM_TYPE;
    }
}