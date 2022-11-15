<?php declare(strict_types=1);

namespace Blog\Infrastructure\Request\ParamConverter;

use Blog\Domain\Bus\DTOInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class DTOParamConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $name = $configuration->getName();
        $class = $configuration->getClass();
        $object = new $class();
        $this->populateObject($request->request->all(), $object);
        $this->populateObject($request->files->all(), $object);
        $request->attributes->set($name, $object);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        return in_array(DTOInterface::class, class_implements($configuration->getClass()), true);
    }

    private function populateObject(array $requestData, mixed $object): void
    {
        foreach ($requestData as $key => $value) {
            if (!property_exists($object, $key)) {
                continue;
            }
            $object->{$key} = $value;
        }
    }
}