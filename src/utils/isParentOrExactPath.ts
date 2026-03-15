export const isParentOrExactPath = (currentPath: string, parentPath: string): boolean => {
  const isExactOrChildPath = currentPath.startsWith(parentPath);

  return isExactOrChildPath && (currentPath === parentPath || currentPath.startsWith(`${parentPath}/`));
};