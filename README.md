# Plugin boilerplate

## Clone

```bash
git clone git@github.com:tombroucke/plugin-boilerplate.git
```

## Rename
```bash
PLUGIN_NAME="my-plugin"
PLUGIN_NAMESPACE="MyPlugin"
rm -rf plugin-boilerplate/.git
mv plugin-boilerplate/plugin-boilerplate.php plugin-boilerplate/"$PLUGIN_NAME".php
mv plugin-boilerplate "$PLUGIN_NAME"
find "$PLUGIN_NAME" -type f -name '*.php' -not -path '"$PLUGIN_NAME"/vendor/*' -exec sed -i '' "s/PluginBoilerplate/${PLUGIN_NAMESPACE}/g" {} \;
find "$PLUGIN_NAME" -type f -name '*.php' -not -path '"$PLUGIN_NAME"/vendor/*' -exec sed -i '' "s/plugin-boilerplate/${PLUGIN_NAME}/g" {} \;
sed -i '' "s/PluginBoilerplate/${PLUGIN_NAMESPACE}/g" "$PLUGIN_NAME"/composer.json
```

