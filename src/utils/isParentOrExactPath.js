export const isParentOrExactPath = (currentPath, parentPath) => {
  const isExactOrChildPath = currentPath.startsWith(parentPath);
  
  return isExactOrChildPath && (currentPath === parentPath || currentPath.startsWith(`${parentPath}/`));
};